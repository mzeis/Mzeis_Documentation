<?php

class Mzeis_Documentation_Model_Resource_Page_File
{
    /**
     * Tries to guess the module name from the file path if no module name
     * was defined (e.g. when executing a search).
     *
     * @param array $data Page data
     * @return array Enriched page data
     */
    protected function _addModuleName(array $data)
    {
        if (!isset($data['module']) && isset($data['filename'])) {
            $codeDir = Mage::app()->getConfig()->getOptions()->getCodeDir();
            if (strpos($data['filename'], $codeDir) !== 0) {
                throw new Exception ('File is not in code directory');
            }
            $pattern = '#^' . $codeDir . '#i';
            $relativePath = ltrim(preg_replace($pattern, '', $data['filename']), '/');
            $parts = explode(DS, $relativePath);
            if (count($parts) > 3) {
                $codePool = array_shift($parts);
                if (in_array($codePool, array('core', 'community', 'local'))) {
                    $data['module'] = array_shift($parts) . '_' . array_shift($parts);
                }
            }
        }
        return $data;
    }

    /**
     * Returns the absolute path to the module directory.
     *
     * @param string $name
     * @return string
     */
    protected function _getModuleDir($name)
    {
        return Mage::getModuleDir('base', $name);
    }

    /**
     * @param string $name
     * @return bool True if it is a file with the allowed extension
     */
    protected function _isValidFile($name)
    {
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        return in_array($extension, Mage::helper('mzeis_documentation/page_file')->getAllowedExtensions());
    }

    /**
     * @param string $name
     * @return bool True if it is an existing, active module
     */
    protected function _isValidModule($name)
    {
        return Mage::helper('mzeis_documentation/module')->isActiveModule($name);
    }

    /**
     * Returns the URL to a file based on the current page.
     *
     * If this method is not called on a module page or no module is set the path will be returned as is.
     *
     * @param Mzeis_Documentation_Model_Page $page
     * @param string $relativePath
     */
    public function getUrlTo(Mzeis_Documentation_Model_Page $page, $relativePath, array $params)
    {
        if (!$page->isModulePage() || is_null($page->getModule())) {
            return $relativePath;
        }

        $pattern = '#' . Mage::getBaseDir() . '#i';
        $path = ltrim(preg_replace($pattern, '', $this->_getModuleDir($page->getModule())) . DS . $relativePath, DS);
        return Mage::getBaseUrl() . $path;
    }

    /**
     * Determines the data for this page file.
     *
     * @param array $data
     */
    public function getPageData(array $data)
    {
        $data = $this->_addModuleName($data);

        /**
         * If the module defined is no valid module: return without loading data.
         */
        if (!$this->_isValidModule($data['module'])) {
            $data['module'] = null;
            return $data;
        }

        $moduleDir = $this->_getModuleDir($data['module']);

        if (!isset($data['filename'])) {
            $data['filename'] = $moduleDir . DS . $data['name'];
        }

        /**
         * If the file is not valid: return without loading data.
         */
        if (!$this->_isValidFile($data['filename'])) {
            $data['filename'] = null;
            return $data;
        }

        if (!isset($data['basename'])) {
            $data['basename'] = basename($data['filename']);
        }

        $pattern = '#^' . $moduleDir . '#i';
        $data['relativename'] = ltrim(preg_replace($pattern, '', $data['filename']), '/');

        $data['id'] = $data['filename'];
        $data['name'] = $data['relativename'];
        $data['type'] = Mzeis_Documentation_Model_Page::TYPE_MODULE;

        $file = new Varien_Io_File;
        $file->open(array('path' => dirname($data['filename'])));
        $data['content'] = $file->read($data['basename']);
        if (is_string($data['content'])) {
            $data['format']= Mzeis_Documentation_Model_Page::FORMAT_MARKDOWN;
            $data['source'] = Mzeis_Documentation_Model_Page::SOURCE_FILE;
        }

        return $data;
    }

    /**
     * Tries to load the information from the file.
     *
     * @param Mzeis_Documentation_Model_Page $page
     * @return void
     */
    public function loadFromFile(Mzeis_Documentation_Model_Page $page)
    {
        $data = $this->getPageData($page->getData());
        $page->addData($data);
    }
}
