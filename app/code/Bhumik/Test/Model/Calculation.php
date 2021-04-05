<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Bhumik\Test\Api\Data\CalculationInterface;
use Bhumik\Test\Model\ResourceModel\Calculation as ResourceModel;

class Calculation extends AbstractModel implements CalculationInterface, IdentityInterface
{

	const CACHE_TAG = 'bhumik_test_calculations';

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Bhumik\Test\Model\ResourceModel\Calculation');
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId()
    {
        return $this->getData('entity_id');
    }
    public function setId($car_id)
    {
        return $this->setData('entity_id', $entity_id);
    }
}