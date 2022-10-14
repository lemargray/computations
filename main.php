<?php

use App\Rules\RuleGCT;
use App\TradeComputation;

require 'vendor/autoload.php';

$rules = require __DIR__ . '/src/data/CalculationTypes.php';
$order = require __DIR__ . '/src/data/Order.php';
$tradeScenario = require __DIR__ . '/src/data/TradeScenario.php';

$principal = $order['units'] * $order['price'];

$computations = (new TradeComputation())->calculate($principal, $tradeScenario, $rules);

print_r($computations);