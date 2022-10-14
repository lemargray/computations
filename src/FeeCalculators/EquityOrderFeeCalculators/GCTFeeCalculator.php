<?php

namespace App\FeeCalculators\EquityOrderFeeCalculators;

use App\FeeCalculators\Interfaces\FeeCalculatorInterface;

class GCTFeeCalculator implements FeeCalculatorInterface
{
    public function execute($principal, $effect, $rule) : float
    {
        return $principal * .15 * $effect;
    }
}