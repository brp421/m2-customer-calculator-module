<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Controller\Calculation;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Bhumik\Test\Model\CalculationFactory;
use Bhumik\Test\Helper\Data;

class Save extends \Magento\Framework\App\Action\Action
{
	/**
     * @var Calculation
     */
    protected $_calculation;

    /**
     * @var Session
     */
    protected $session;

    public function __construct(
		Context $context,
        Session $customerSession,
        Data $calculationData,
        CalculationFactory $calculation
    ) {
        $this->session = $customerSession;
        $this->_calculation = $calculation;
        $this->_calculationData = $calculationData;
        parent::__construct($context);
    }

	public function execute()
    {
        if($this->session->isLoggedIn()){
            $data = $this->getRequest()->getParams();

            $mathResult = '';
            if (!empty($data["operation"]) && $data["operation"] != "") {
                switch ($data["operation"]) {
                    case 'plus':
                        $mathResult = $this->_calculationData->add($data["inputleft"], $data["inputright"]);
                        break;
                    case 'minus':
                        $mathResult = $this->_calculationData->subtract($data["inputleft"], $data["inputright"]);
                        break;
                    case 'multiply':
                        $mathResult = $this->_calculationData->multiply($data["inputleft"], $data["inputright"]);
                        break;
                    case 'divide':
                        $mathResult = $this->_calculationData->divide($data["inputleft"], $data["inputright"]);
                        break;
                    default:
                        $mathResult = null;
                }
            }
            $data["result"] = $mathResult;
        	$calculation = $this->_calculation->create();
            $calculation->setData($data);

            if($calculation->save()) {
                $message = "Your calculation ".$data["inputleft"]." ".$data["operation"]." ".$data["inputright"]." = ".$data["result"]." is saved successfully.";
                $this->messageManager->addSuccessMessage($message);
            }
            else {
                $this->messageManager->addErrorMessage(__('Data was not saved. Please try again.'));
            }

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/calculation');
            return $resultRedirect;
        } else {
            return $this->resultRedirectFactory->create()->setPath('customer/account');
        }
    }
}
