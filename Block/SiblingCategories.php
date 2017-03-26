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
use Magento\Framework\Registry;
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
    protected $_helper;

    /**
     * @var Registry
     */
    private $registry;
    private $_productCollectionFactory;

    public function __construct(Context $context,
                                Navigation $navigation,
                                Data $helper,
                                Registry $registry,
                                CollectionFactory $productCollectionFactory,
                                array $data = [])
    {

        $this->navigation = $navigation;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_helper = $helper;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Catalog\Model\Category[]|\Magento\Catalog\Model\ResourceModel\Category\Collection|null
     */
    public function getSiblingCategories()
    {
        $categories = null;
        if ($this->isFirstLevel($this->getCurrentParent())) {
            if ($this->showInFirstLevel()) {
                $categories = $this->getCurrentParent()->getChildrenCategories();
            }
        } else {
            $categories = $this->getCurrentParent()->getParentCategory()->getChildrenCategories();
        }

        if (!is_null($categories) && $this->addCount()) {
            $this->addCountToCategories($categories);
        }

        return $categories;
    }

    /**
     * @param $category
     *
     * @return bool
     */
    private function isFirstLevel($category)
    {
        return $category->getData('level') == 1 ? true : false;
    }

    /**
     * @return \Magento\Catalog\Model\Category
     */
    protected function getCurrentParent()
    {
        return $this->getCurrentCategory()->getParentCategory();
    }

    /**
     * @return mixed
     */
    public function getCurrentCategory()
    {
//        return $this->registry->registry('current_category');
        return $this->navigation->getCurrentCategory();
    }

    /**
     * @return bool
     */
    private function showInFirstLevel()
    {
        return (bool) $this->_helper->showFirstLevel();
    }

    /**
     * @return bool
     */
    protected function addCount(): bool
    {
        return $this->_helper->addCount();
    }

    /**
     * @param $categories
     */
    protected function addCountToCategories($categories)
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = $this->_productCollectionFactory->create();
        $this->getCurrentCategory()->prepareProductCollection($productCollection);
        $productCollection->addCountToCategories($categories);
        $this->removeCurrentCategory($categories);
    }

    /**
     * @param $categories
     */
    protected function removeCurrentCategory($categories)
    {
        $categories->removeItemByKey($this->getCurrentCategory()->getId());
    }

    public function getCategoryUrl($_category)
    {
        return $this->navigation->getCategoryUrl($_category);
    }
}

