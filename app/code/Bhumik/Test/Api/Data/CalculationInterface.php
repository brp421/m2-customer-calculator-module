<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Api\Data;

/**
 * Interface CalculationInterface
 *
 * @api
 */
interface CalculationInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $entiry_id
     * @return $this
     */
    public function setId($entiry_id);

}