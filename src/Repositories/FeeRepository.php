<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FeeRepositoryInterface;

class FeeRepository implements FeeRepositoryInterface
{
    protected $fees;

    public function __construct()
    {
        $this->fees = require __DIR__ . '/../data/Fees.php';
    }

    public function getDefaultFee($feeTypeCode, $effectiveDate)
    {
        foreach($this->fees as $fee) 
        {
            if ($fee['feeTypeCode'] == $feeTypeCode)
            {
                return $fee;
            }
        }

        return null;
    }

    public function getSlidingScaleFees($feeTypeCode, $amount, $effectiveDate)
    {
        $slidingScaleFees = [];

        foreach($this->fees as $fee) 
        {
            if ($fee['feeTypeCode'] == $feeTypeCode) 
            {
                $slidingScaleFees[] = $fee;
            }
        }

        return $slidingScaleFees;
    }
}