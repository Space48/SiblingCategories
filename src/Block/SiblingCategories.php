<?php

declare(strict_types = 1);

namespace Space48\SiblingCategories\Block;

use Magento\Catalog\Block\Navigation;
use Magento\Framework\View\Element\Template;

class SiblingCategories extends Template
{

    protected $_navigation;

    public function __construct(Template\Context $context, Navigation $navigation, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_navigation = $navigation;
    }

    public function getCategory()
    {
        return $this->_navigation->getCategory();
    }

    public function getCurrentChildCategories()
    {
        return $this->_navigation->getCurrentChildCategories();
    }

    public function getCategoryUrl($_category)
    {
        return $this->_navigation->getCategoryUrl($_category);
    }

    public function getPotato()
    {
        return __("Hello I am Alive");
    }
}

