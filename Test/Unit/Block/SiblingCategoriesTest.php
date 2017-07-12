<?php
/**
 * SiblingCategoriesTest.php
 *
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

class SiblingCategoriesTest extends \PHPUnit_Framework_TestCase
{

    /** @var  \Space48\SiblingCategories\Block\SiblingCategories */
    private $block;

    public function setUp()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject | Context $stubContext */
        $stubContext = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject | Navigation $stubNavigation */
        $stubNavigation = $this->getMockBuilder(Navigation::class)
            ->disableOriginalConstructor()
            ->getMock();

        /** @var \PHPUnit_Framework_MockObject_MockObject | Data $stubHelper */
        $stubHelper = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()
            ->getMock();
        /** @var \PHPUnit_Framework_MockObject_MockObject | CollectionFactory $stubProductCollection */
        $stubProductCollection = $this->getMockBuilder(CollectionFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->block = new SiblingCategories($stubContext, $stubNavigation, $stubHelper, $stubProductCollection);
    }

    public function testBlockIsInstanceOfTemplate()
    {
        $this->assertInstanceOf(Template::class, $this->block);
    }

}
