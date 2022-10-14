<?php

namespace App;

interface TradeComputationCalculatorInterface
{
    public function calculate($principal, $tradeScenario, $rules) : array;
}