<?php

namespace App\FeeCalculators\EquityOrderFeeCalculators;

use App\FeeCalculators\Interfaces\FeeCalculatorInterface;

class JCSDFeeCalculator implements FeeCalculatorInterface
{
    public function execute($principal, $effect, $rule) : float
    {
        return $principal * .02 * $effect;
    }
}