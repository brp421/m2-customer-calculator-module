<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Model\ResourceModel;

class Calculation extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('bhumik_test_calculations', 'entity_id');
    }
}