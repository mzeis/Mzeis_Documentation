<?php

class Mzeis_Documentation_Model_Page_Renderer
{
    const LINK_PATTERN = '/\[\[(.*?)\]\]/';

    public function renderContent(Mzeis_Documentation_Model_Page $page)
    {
        $content = $page->getContent();

        $found = preg_match_all(self::LINK_PATTERN, $content, $linkedPages);
        if ($found) {
            $helper = Mage::helper("mzeis_documentation/page");

            /**
             * @var $collection Mzeis_Documentation_Model_Resource_Page_Collection
             */
            $collection = Mage::getModel('mzeis_documentation/page')->getCollection();
            $collection
                ->addFieldToSelect('name')
                ->addFieldToFilter('name', $linkedPages[1]);
            $existingPages = $collection->getConnection()->fetchCol($collection->getSelect());

            foreach ($existingPages as $existingPage) {
                $content = str_replace('[[' . $existingPage . ']]', '<a href="' . $helper->getViewUrl($existingPage) . '" class="mzeis-documentation-page-found">' . $existingPage . '</a>', $content);
            }

            foreach (array_diff($linkedPages[1], $existingPages) as $nonExistingPage) {
                $content = str_replace('[[' . $nonExistingPage . ']]', '<a href="' . $helper->getViewUrl($nonExistingPage) . '" class="mzeis-documentation-page-not-found">' . $nonExistingPage . '</a>', $content);
            }
        }
        return $content;
    }
}
