<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Bhumik\Test\Helper;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    CONST DEFAULT_PRECISION = 2;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Add numbers
     *
     * @param float|int $left
     * @param float|int $right
     * @return float|int result
     */
    public function add($left, $right)
    {
        return round($left + $right, self::DEFAULT_PRECISION);
    }

    /**
     * Subtract numbers
     *
     * @param float|int $left
     * @param float|int $right
     * @return float|int result
     */
    public function subtract($left, $right)
    {
        return round($left - $right, self::DEFAULT_PRECISION);
    }

    /**
     * Multiply numbers
     *
     * @param float|int $left
     * @param float|int $right
     * @return float|int result
     */
    public function multiply($left, $right)
    {
        return round($left * $right, self::DEFAULT_PRECISION);
    }

    /**
     * Divide numbers
     *
     * @param float|int $left
     * @param float|int $right
     * @return float|int result
     */
    public function divide($left, $right)
    {
        return round($left / $right, self::DEFAULT_PRECISION);
    }
}
