<?php

/**
 * Documentation page model
 *
 * @method string getCreatedAt()
 * @method string getCreatedUser()
 * @method string getFormat()
 * @method string getModule()
 * @method string getName()
 * @method string getSource()
 * @method string getType()
 * @method string getUpdatedAt()
 * @method string getUpdatedUser()
 * @method setCreatedAt(string $value)
 * @method setCreatedUser(string $value)
 * @method setFormat(string $value)
 * @method setModule(string $value)
 * @method setName(string $value)
 * @method setSource(string $value)
 * @method setType(string $value)
 * @method setUpdatedAt(string $value)
 * @method setUpdatedUser(string $value)
 */
class Mzeis_Documentation_Model_Page extends Mage_Core_Model_Abstract
{
    /**
     * Page format is Magento CMS flavoured HTML
     *
     * @var string
     */
    const FORMAT_MAGE_CMS = 'mage_cms';

    /**
     * Page format is Markdown
     *
     * @var string
     */
    const FORMAT_MARKDOWN = 'markdown';

    /**
     * Page originates from database
     *
     * @var string
     */
    const SOURCE_DATABASE = 'database';

    /**
     * Page originates from file
     *
     * @var string
     */
    const SOURCE_FILE = 'file';

    /**
     * Page type for module documentation
     *
     * @var string
     */
    const TYPE_MODULE = 'module';

    /**
     * Page type for project documentation
     *
     * @var string
     */
    const TYPE_PROJECT = 'project';

    /**
     * @return int
     */
    protected function _construct()
    {
        $this->_init('mzeis_documentation/page');
    }

    /**
     * Normalizes a path by removing '.' and '..'.
     *
     * @copyright runeimp@gmail.com (http://php.net/manual/de/function.realpath.php#112367)
     * @param string $path
     * @return string
     */
    protected function _normalizePath($path)
    {
        $parts = array();
        $path = str_replace('\\', '/', $path);
        $path = preg_replace('/\/+/', '/', $path);
        $segments = explode('/', $path);
        foreach($segments as $segment) {
            if($segment != '.') {
                $test = array_pop($parts);
                if(is_null($test)) {
                    $parts[] = $segment;
                } else if($segment == '..') {
                    if($test == '..') {
                        $parts[] = $test;
                    }

                    if($test == '..' || $test == '') {
                        $parts[] = $segment;
                    }
                } else {
                    $parts[] = $test;
                    $parts[] = $segment;
                }
            }
        }
        return implode('/', $parts);
    }

    /**
     * Returns an instance of the module of the page (if a module is set).
     *
     * @return Mzeis_Documentation_Model_Module|null
     */
    public function getModuleInstance()
    {
        if ($this->getModule()) {
            $module = Mage::getModel('mzeis_documentation/module');
            $module->setName($this->getModule());
            return $module;
        }
        return null;
    }

    /**
     * Returns the URL Key.
     *
     * @return string
     */
    public function getUrlKey()
    {
        if ($this->hasRelativename()) {
            return $this->getRelativename();
        }

        return $this->getName();
    }

    /**
     * Returns the URL to a file or page based on the current page.
     *
     * @param string $relativePath
     * @param array $params URL parameters
     * @return string
     */
    public function getUrlTo($relativePath, array $params)
    {
        $fileInfo = pathinfo($relativePath);

        if (isset($fileInfo['extension']) &&
            !in_array($fileInfo['extension'], Mage::helper('mzeis_documentation/page_file')->getAllowedExtensions())) {
            // Return absolute path to the file for every non-page.

            return Mage::getResourceSingleton('mzeis_documentation/page_file')->getUrlTo($this, $relativePath, $params);
        }

        $query['page'] = $relativePath;
        if ($this->hasModule()) {
            $query['module'] = $this->getModule();
            $query['page'] = $this->_normalizePath(pathinfo($this->getRelativename(), PATHINFO_DIRNAME) . DS . $relativePath);
        }
        $params['_query'] = isset($params['_query']) ? array_merge($params['_query'], $query) : $query;

        return Mage::helper("adminhtml")->getUrl('adminhtml/mzeis_documentation/view', $params);
    }

    /**
     * Returns whether the page content is written in Markdown.
     *
     * @return bool
     */
    public function isFormatMarkdown()
    {
        return $this->getFormat() == self::FORMAT_MARKDOWN;
    }

    /**
     * Returns whether this page is a module page.
     *
     * @return bool
     */
    public function isModulePage()
    {
        return $this->getType() == self::TYPE_MODULE;
    }

    /**
     * Returns whether this page is a project page.
     *
     * @return bool
     */
    public function isProjectPage()
    {
        return $this->getType() == self::TYPE_PROJECT;
    }

    /**
     * Loads the page by the name.
     *
     * @param $name
     * @return Mzeis_Documentation_Model_Page
     */
    public function loadByName($name)
    {
        $this->load($name, 'name');
        return $this;
    }

    /**
     * Renames the links in all pages from the old to the new name.
     *
     * @param $oldName
     * @param $newName
     * @return Mzeis_Documentation_Model_Page
     */
    public function renameLinks($oldName, $newName)
    {
        $this->getResource()->renameLinks($oldName, $newName);
        return $this;
    }

    /**
     * Returns whether a page originates from the database.
     *
     * @return bool
     */
    public function sourceIsDatabase()
    {
        return $this->getSource() == self::SOURCE_DATABASE;
    }

    /**
     * Returns whether a page originates from a file.
     *
     * @return bool
     */
    public function sourceIsFile()
    {
        return $this->getSource() == self::SOURCE_FILE;
    }
}
