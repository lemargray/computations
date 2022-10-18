<?php

namespace App\Repositories\Interfaces;

interface FeeRepositoryInterface 
{
    public function getDefaultFee($feeTypeCode, $effectiveDate);
    public function getSlidingScaleFees($feeTypeCode, $amount, $effectiveDate);
}