<?php

namespace App\Rules;

interface ExecutableRuleInterface
{
    public function execute($principal, $effect, $rule) : float;
}