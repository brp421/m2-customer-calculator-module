<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Model\ResourceModel\Calculation;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Bhumik\Test\Model\Calculation',
            'Bhumik\Test\Model\ResourceModel\Calculation'
        );
    }


}