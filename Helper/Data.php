<?php

declare(strict_types=1);

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
        return $this->getConfig('enabled');
    }

    /**
     * @param $field
     *
     * @return string
     */
    private function getConfig($field)
    {
        return $this->scopeConfig->getValue(
            "space48_siblingcategories/general/" . $field,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function showFirstLevel()
    {
        return $this->getConfig('show_first_level');
    }

    /**
     * @return bool
     */
    public function addCount()
    {
        return $this->getConfig('add_count');
    }
}

