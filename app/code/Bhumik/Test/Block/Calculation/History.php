<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Block\Calculation;

use Bhumik\Test\Model\ResourceModel\Calculation\CollectionFactory as CalculationCollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Test content block
 */
class History extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @var \Bhumik\Test\Model\ResourceModel\Calculation\CollectionFactory
     */
    private $calculationCollectionFactory;

    /**
     * @var \Bhumik\Test\Model\ResourceModel\Calculation\Collection
     */
    private $calculationCollection;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param AddressCollectionFactory $addressCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        CalculationCollectionFactory $calculationCollectionFactory,
        array $data = []
    ) {
        $this->currentCustomer = $currentCustomer;
        $this->calculationCollectionFactory = $calculationCollectionFactory;

        parent::__construct($context, $data);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Bhumik Test Module'));
        
        $this->preparePager();
        return parent::_prepareLayout();
    }

    /**
     * Generate and return "New Address" URL
     *
     * @return string
     * @since 102.0.1
     */
    public function getAddAddressUrl(): string
    {
        return $this->getUrl('customer/calculation/index', ['_secure' => true]);
    }

    /**
     * Generate and return "Delete" URL
     *
     * @return string
     * @since 102.0.1
     */
    public function getDeleteUrl(): string
    {
        return $this->getUrl('customer/calculation/delete');
    }

    /**
     * Get current customer calculations
     *
     * Return array of calculations
     *
     * @return array[]
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws NoSuchEntityException
     * @since 102.0.1
     */
    public function getAdditionalCalculations(): array
    {
        $additional = [];
        $calculationEntries = $this->getCalculationCollection();
        foreach ($calculationEntries as $entry) {
            $additional[] = $entry;
        }
        return $additional;
    }

    /**
     * Get current customer
     *
     * Return stored customer or get it from session
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     * @since 102.0.1
     */
    public function getCustomer(): \Magento\Customer\Api\Data\CustomerInterface
    {
        $customer = $this->getData('customer');
        if ($customer === null) {
            $customer = $this->currentCustomer->getCustomer();
            $this->setData('customer', $customer);
        }
        return $customer;
    }

    /**
     * Get pager layout
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function preparePager(): void
    {
        $calculationCollection = $this->getCalculationCollection();
        if (null !== $calculationCollection) {
            $pager = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'customer.addresses.pager'
            )->setCollection($calculationCollection);
            $this->setChild('pager', $pager);
        }
    }

    /**
     * Get customer calculations collection.
     *
     * Filters collection by customer id
     *
     * @return \Bhumik\Test\Model\ResourceModel\Calculation\Collection
     * @throws NoSuchEntityException
     */
    private function getCalculationCollection(): \Bhumik\Test\Model\ResourceModel\Calculation\Collection
    {
        if (null === $this->calculationCollection) {
            if (null === $this->getCustomer()) {
                throw new NoSuchEntityException(__('Customer not logged in'));
            }

            /** @var \Bhumik\Test\Model\ResourceModel\Calculation\Collection $collection */
            $collection = $this->calculationCollectionFactory->create();
            $collection->setOrder('entity_id', 'desc');
            $collection->addFieldToFilter('customer_id',['eq' => $this->getCustomer()->getId()]);
            $this->calculationCollection = $collection;
        }

        return $this->calculationCollection;
    }

}
