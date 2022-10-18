<?php

namespace App\Rules;

class MinimumRule extends BaseRule
{
    public function shouldApply(): bool
    {
        return !empty($this->feeConfig['minimum']) && 
            abs($this->deal->getFee($this->feeConfig['label'])) < $this->feeConfig['minimum'];
    }

    public function apply() : float
    {
        return $this->feeConfig['minimum'];
    }
}