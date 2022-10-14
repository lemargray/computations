<?php

namespace App\Rules;

class RuleGCT implements ExecutableRuleInterface
{
    public function execute($principal, $effect, $rule) : float
    {
        return $principal * .15 * $effect;
    }
}