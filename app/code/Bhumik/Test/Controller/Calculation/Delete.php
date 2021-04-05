<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Bhumik\Test\Controller\Calculation;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Delete customer address controller action.
 */
class Delete extends \Magento\Framework\App\Action\Action implements HttpPostActionInterface, HttpGetActionInterface
{

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     * @param \Bhumik\Test\Api\CalculationRepositoryInterface $calculationRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Bhumik\Test\Api\CalculationRepositoryInterface $calculationRepository
      ){
        $this->_customerSession = $customerSession;
        $this->_formKeyValidator = $formKeyValidator;
        $this->_calculationRepository = $calculationRepository;
        parent::__construct($context);
    }

    /**
     * Retrieve customer session object
     *
     * @return \Magento\Customer\Model\Session
     */
    protected function _getSession()
    {
        return $this->_customerSession;
    }

    /**
     * @inheritdoc
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $calculationId = $this->getRequest()->getParam('id', false);
        if ($calculationId && $this->_formKeyValidator->validate($this->getRequest())) {
            try {
                $calc = $this->_calculationRepository->getById($calculationId);
                if ($calc->getCustomerId() === $this->_getSession()->getCustomerId()) {
                    $this->_calculationRepository->deleteById($calculationId);
                    $this->messageManager->addSuccessMessage(__('You deleted the entry.'));
                } else {
                    $this->messageManager->addErrorMessage(__('We can\'t delete the entry right now.'));
                }
            } catch (\Exception $other) {
                $this->messageManager->addException($other, __('We can\'t delete the entry right now.'));
            }
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/history');
    }
}
