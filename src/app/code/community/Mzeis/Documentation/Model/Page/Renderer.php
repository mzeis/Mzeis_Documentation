<?php

class Mzeis_Documentation_Model_Page_Renderer
{
    const LINK_PATTERN = '/\[\[(.*?)\]\]/';

    /**
     * Renders the page content.
     *
     * Internal documentation links are inserted and CMS template filters applied.
     *
     * @param Mzeis_Documentation_Model_Page $page
     * @return string
     */
    public function renderContent(Mzeis_Documentation_Model_Page $page)
    {
        $content = $page->getContent();

        switch ($page->getFormat()) {
            case Mzeis_Documentation_Model_Page::FORMAT_MARKDOWN:
                $parser = Mzeis_Documentation_Model_Parsedown::instance();
                $parser->setPage($page);
                $content = $parser->text($content);
                break;
            case Mzeis_Documentation_Model_Page::FORMAT_MAGE_CMS:
            default:
                $content = $this->_renderDocumentationLinks($content);
                $content = $this->_renderWidgets($content);
                break;
        }

        return $content;
    }

    /**
     * @param string $content
     * @return string
     * @throws Exception
     */
    protected function _renderDocumentationLinks($content)
    {
        $found = preg_match_all(self::LINK_PATTERN, $content, $linkedPages);
        if ($found) {
            $helper = Mage::helper("mzeis_documentation/page");

            /**
             * @var $collection Mzeis_Documentation_Model_Resource_Page_Collection
             */
            $collection = Mage::getModel('mzeis_documentation/page')->getCollection();
            $collection->addTypeFilter(Mzeis_Documentation_Model_Page::TYPE_PROJECT)
                       ->addPageFilter($linkedPages[1]);

            // Render links to existing pages
            foreach ($collection as $page) {
                $content = str_replace('[[' . $page->getName() . ']]', '<a href="' . $helper->getViewUrl($page) . '" class="mzeis-documentation-page-found">' . $page->getName() . '</a>', $content);
                $arrayKeys = array_keys($linkedPages[1], $page->getName());
                foreach ($arrayKeys as $arrayKey) {
                    unset($linkedPages[0][$arrayKey]);
                    unset($linkedPages[1][$arrayKey]);
                }
            }

            // Render links to non-existing pages
            foreach ($linkedPages[1] as $nonExistingPage) {
                $page = Mage::getSingleton('mzeis_documentation/page')->setName($nonExistingPage);
                $content = str_replace('[[' . $nonExistingPage . ']]', '<a href="' . $helper->getViewUrl($page) . '" class="mzeis-documentation-page-not-found">' . $nonExistingPage . '</a>', $content);
            }
        }
        return $content;
    }

    /**
     * @param string $content
     * @return string
     * @throws Exception
     */
    protected function _renderWidgets($content)
    {
        $appEmulation = Mage::getSingleton( 'core/app_emulation' );
        $initialEnvironmentInfo = $appEmulation->startEnvironmentEmulation(Mage_Core_Model_App::ADMIN_STORE_ID);
        $content  = Mage::helper('cms')->getPageTemplateProcessor()->filter($content);
        $appEmulation->stopEnvironmentEmulation($initialEnvironmentInfo);
        return $content;
    }
}
