<?php

namespace App\Rules;

class RuleJCSDFee implements ExecutableRuleInterface
{
    public function execute($principal, $effect, $rule) : float
    {
        return $principal * .02 * $effect;
    }
}