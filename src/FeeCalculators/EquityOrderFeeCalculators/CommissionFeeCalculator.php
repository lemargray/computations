<?php

namespace App\FeeCalculators\EquityOrderFeeCalculators;

use App\FeeCalculators\Interfaces\FeeCalculatorInterface;

class CommissionFeeCalculator implements FeeCalculatorInterface
{
    public function execute($data, $effect, $rule) : float
    {
        return $data['units'] * $data['price'] * .15 * $effect;
    }
}