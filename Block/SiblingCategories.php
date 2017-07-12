<?php

/**
 * Space48_SiblingCategories
 *
 * @category    Space48
 * @package     Space48_SiblingCategories
 * @Date        02/2017
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author      @diazwatson
 */

declare(strict_types=1);

namespace Space48\SiblingCategories\Block;

use Magento\Catalog\Block\Navigation;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Space48\SiblingCategories\Helper\Data;

class SiblingCategories extends Template
{

    /**
     * @var Navigation
     */
    protected $navigation;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var CollectionFactory
     */
    private $productCollectionFactory;

    /**
     * SiblingCategories constructor.
     *
     * @param Context           $context
     * @param Navigation        $navigation
     * @param Data              $helper
     * @param CollectionFactory $productCollectionFactory
     * @param array             $data
     */
    public function __construct(
        Context $context,
        Navigation $navigation,
        Data $helper,
        CollectionFactory $productCollectionFactory,
        array $data = []
    ) {

        $this->navigation = $navigation;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    /**
     * Get Sibling Categories
     *
     * @return \Magento\Catalog\Model\Category[]|\Magento\Catalog\Model\ResourceModel\Category\Collection|null
     */
    public function getSiblingCategories()
    {
        if ($this->isFirstLevel($this->getCurrentCategory()) && $this->showInFirstLevel() == false) {
            return [];
        }

        return $this->getCurrentParent()->getChildrenCategories();
    }

    /**
     * Check if Category is fist level
     *
     * @param $category \Magento\Catalog\Model\Category
     *
     * @return bool
     */
    private function isFirstLevel($category)
    {
        return $category->getData('level') == 2 ? true : false;
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    public function getCurrentCategory()
    {
        return $this->navigation->getCurrentCategory();
    }

    /**
     * @return bool
     */
    private function showInFirstLevel()
    {
        return $this->helper->showFirstLevel();
    }

    /**
     * Get Parent of current Category
     *
     * @return \Magento\Catalog\Model\Category
     */
    private function getCurrentParent()
    {
        return $this->getCurrentCategory()->getParentCategory();
    }

    /**
     * @param $_category
     *
     * @return string
     */
    public function getCategoryUrl($_category)
    {
        return $this->navigation->getCategoryUrl($_category);
    }

    /**
     * @return bool
     */
    public function addCount()
    {
        return $this->helper->addCount();
    }
}

