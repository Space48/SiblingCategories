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

declare(strict_types = 1);

namespace Space48\SiblingCategories\Block;

use Magento\Catalog\Block\Navigation;
use Magento\Catalog\Helper\Category;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Catalog\Model\Indexer\Category\Flat\State;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

class SiblingCategories extends Navigation
{

    public function __construct(Context $context,
                                CategoryFactory $categoryFactory,
                                CollectionFactory $productCollectionFactory,
                                Resolver $layerResolver,
                                HttpContext $httpContext,
                                Category $catalogCategory,
                                Registry $registry,
                                State $flatState,
                                ScopeConfigInterface $scopeConfig,
                                array $data = [])
    {
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $categoryFactory, $productCollectionFactory, $layerResolver, $httpContext,
            $catalogCategory, $registry, $flatState, $data);
    }

    /**
     * @return \Magento\Catalog\Model\Category[]|\Magento\Catalog\Model\ResourceModel\Category\Collection|null
     */
    public function getCurrentSiblingCategories()
    {
        $categories = null;
        if ($this->isFirstLevel($this->getCurrentParent())) {
            if ($this->showInFirstLevel()) {
                $categories = $this->getCurrentParent()->getChildrenCategories();
//                $this->addCountToCategories($categories);
            }
        } else {
            $categories = $this->getCurrentParent()->getParentCategory()->getChildrenCategories();
//            $this->addCountToCategories($categories);
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
        return $this->_catalogLayer->getCurrentCategory()->getParentCategory();
    }

    /**
     * @return bool
     */
    private function showInFirstLevel()
    {
        return (bool) $this->getConfig('show_first_level');
    }

    /**
     * @param $categories
     */
    protected function addCountToCategories($categories)
    {
        if ($this->getConfig('add_count')) {
            /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
            $productCollection = $this->_productCollectionFactory->create();
            $this->_catalogLayer->prepareProductCollection($productCollection);
            $productCollection->addCountToCategories($categories);
            $this->removeCurrentCategory($categories);
        }
    }

    /**
     * @param $categories
     */
    protected function removeCurrentCategory($categories)
    {
        $categories->removeItemByKey($this->_catalogLayer->getCurrentCategory()->getId());
    }

    /**
     * @return bool
     */
    public function canShow()
    {
        return $this->getConfig('enabled') && !is_null($this->getCurrentSiblingCategories());
    }

    /**
     * @param $field
     *
     * @return bool
     */
    private function getConfig($field)
    {
        return (bool) $this->_scopeConfig->getValue("space48_siblingcategories/general/" . $field,
            ScopeInterface::SCOPE_STORE);
    }
}

