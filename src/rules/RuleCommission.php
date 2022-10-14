<?php

namespace App\Rules;

class RuleCommission
{
    public function execute($data, $effect, $rule) : float
    {
        return $data['units'] * $data['price'] * .15 * $effect;
    }
}