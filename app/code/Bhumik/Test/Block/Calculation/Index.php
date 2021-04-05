<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Block\Calculation;

/**
 * Test content block
 */
class Index extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession
    ) {
        parent::__construct($context);

        $this->customerSession = $customerSession;
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Bhumik Test Module'));
        
        return parent::_prepareLayout();
    }

    public function getCustomerId() {
        return $this->customerSession->getCustomer()->getId();
    }

    public function getFormAction()
    {
        return $this->getUrl('customer/calculation/save', ['_secure' => true]);
    }
}
