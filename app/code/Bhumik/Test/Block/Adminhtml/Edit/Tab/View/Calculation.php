<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bhumik\Test\Block\Adminhtml\Edit\Tab\View;
 
use Magento\Customer\Controller\RegistryConstants;
 
/**
 * Adminhtml customer recent orders grid block
 */
class Calculation extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry|null
     */
    protected $_coreRegistry = null;
 
    /**
     * @var \Bhumik\Test\Model\ResourceModel\Calculation\CollectionFactory
     */
    protected $_collectionFactory;
 
    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Bhumik\Test\Model\ResourceModel\Calculation\CollectionFactory $collectionFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Bhumik\Test\Model\ResourceModel\Calculation\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Psr\Log\LoggerInterface $logger,
        array $data = []
    ) {
         $this->_logger = $logger;
        $this->_coreRegistry = $coreRegistry;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }
 
    /**
     * Initialize the orders grid.
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('customer_view_calculation_grid');
        $this->setDefaultSort('created_at', 'desc');
        $this->setSortable(true);
        $this->setPagerVisibility(true);
        $this->setFilterVisibility(false);
    }
    /**
     * {@inheritdoc}
     */
    protected function _preparePage()
    {
        $this->getCollection()->setPageSize(5)->setCurPage(1);
    }
 
    /**
     * {@inheritdoc}
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        $collection->setOrder('entity_id', 'desc');
        $collection->addFieldToFilter('customer_id',['eq' => $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID)]);
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    /**
     * {@inheritdoc}
     */
     protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            ['header' => __('ID'), 'index' => 'entity_id', 'type' => 'number', 'width' => '100px']
        );
        $this->addColumn(
            'inputleft',
            [
                'header' => __('Input 1'),
                'index' => 'inputleft',
            ]
        );
        $this->addColumn(
            'operation',
            [
                'header' => __('Product Name'),
                'index' => 'operation',
            ]
        );
        $this->addColumn(
            'inputright',
            [
                'header' => __('Product Name'),
                'index' => 'inputright',
            ]
        );
        $this->addColumn(
            'result',
            [
                'header' => __('Result'),
                'index' => 'result',
            ]
        );
        return parent::_prepareColumns();
    }
 
    /**
     * Get headers visibility
     *
     * @return bool
     *
     * @SuppressWarnings(PHPMD.BooleanGetMethodName)
     */
    public function getHeadersVisibility()
    {
        return $this->getCollection()->getSize() >= 0;
    }
    /**
     * {@inheritdoc}
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('catalog/product/edit', ['id' => $row->getProductId()]);
    }
}