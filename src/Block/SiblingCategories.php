<?php

declare(strict_types = 1);

namespace Space48\SiblingCategories\Block;

use Magento\Catalog\Block\Navigation;
use Magento\Framework\View\Element\Template;

class SiblingCategories extends Template
{

    protected $_navigation;


    public function getCategory()
    {
        return $this->_navigation->getCategory();
    }

    protected function _construct(Navigation $navigation)
    {
        parent::_construct();
        $this->_navigation = $navigation;
    }
}

