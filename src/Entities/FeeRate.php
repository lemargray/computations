<?php

namespace App\Entities;

class FeeRate
{
    private $isPercentage = false;
    private $amount = 0;

    public function __construct($amount, $isPercentage)
    {
        $this->amount = $amount;
        $this->isPercentage = $isPercentage;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function isPercentage()
    {
        return $this->isPercentage;
    }
}