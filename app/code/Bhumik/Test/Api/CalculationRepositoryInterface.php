<?php
/**
 * @category   Bhumik
 * @package    Bhumik_Test
 * @author     bhumik.panchal@abuissa.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Bhumik\Test\Api;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Bhumik\Test\Api\Data\CalculationInterface;

/**
 * Interface CalculationRepositoryInterface
 *
 * @api
 */
interface CalculationRepositoryInterface
{
    /**
     * Create or update a Car.
     *
     * @param CalculationInterface $car
     * @return CalculationInterface
     */
    public function save(CalculationInterface $car);

    /**
     * Get a Car by Id
     *
     * @param int $id
     * @return CalculationInterface
     * @throws NoSuchEntityException If calc with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function getById($id);

    /**
     * Delete a Car
     *
     * @param CalculationInterface $car
     * @return CalculationInterface
     * @throws NoSuchEntityException If calc with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function delete(CalculationInterface $car);

    /**
     * Delete a Car by Id
     *
     * @param int $id
     * @return CalculationInterface
     * @throws NoSuchEntityException If calc with the specified ID does not exist.
     * @throws LocalizedException
     */
    public function deleteById($id);
}