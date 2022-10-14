<?php

namespace App\FeeCalculators\Interfaces;

interface FeeCalculatorInterface
{
    public function execute($principal, $effect, $rule) : float;
}