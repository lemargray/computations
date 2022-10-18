<?php

namespace App\FeeCalculators;

use App\Entities\Deal;

class FeeCalculator extends AbstractFeeCalculator
{
    protected function execute(Deal $deal, $feeConfig) : float
    {
        return 0;
    }
}