<?php

namespace Space48\SiblingCategories\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->_getConfig('enabled');
    }

    /**
     * @return bool
     */
    public function showFirstLevel()
    {
        return $this->_getConfig('show_first_level');
    }

    /**
     * @return bool
     */
    public function addCount()
    {
        return $this->_getConfig('add_count');
    }

    /**
     * @param $field
     *
     * @return bool
     */
    protected function _getConfig($field)
    {
        return (bool) $this->scopeConfig->getValue("space48_siblingcategories/general/" . $field,
            ScopeInterface::SCOPE_STORE);
    }
}

