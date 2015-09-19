<?php

class Mzeis_Documentation_Model_Parsedown extends Parsedown
{
    /**
     * Mzeis_Documentation_Model_Page
     */
    protected $_page = null;

    protected function inlineLink($Excerpt)
    {
        $result = parent::inlineLink($Excerpt);

        if (!is_array($result) || !isset($result['element'])) {
            return $result;
        }

        $hrefInfo = parse_url($result['element']['attributes']['href']);

        if (isset($hrefInfo['host']) || isset($hrefInfo['scheme'])) {
            return $result;
        }

        $params = array();
        if (isset($hrefInfo['fragment'])) {
            $params['_fragment'] = $hrefInfo['fragment'];
        }
        if (isset($hrefInfo['query'])) {
            parse_str(str_replace('&amp;', '&', $hrefInfo['query']), $params['_query']);
        }

        $result['element']['attributes']['href'] = $this->_page->getUrlTo($hrefInfo['path'], $params);

        return $result;
    }

    public function setPage(Mzeis_Documentation_Model_Page $page)
    {
        $this->_page = $page;
    }

}
