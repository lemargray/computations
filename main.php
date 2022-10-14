<?php

require 'vendor/autoload.php';

use App\Rules\RuleGCT;
use App\TradeComputationCalculator;

$feesConfigurations = require __DIR__ . '/src/data/CalculationTypes.php';
$order = require __DIR__ . '/src/data/Order.php';
$tradeScenario = require __DIR__ . '/src/data/TradeScenario.php';

$computations = (new TradeComputationCalculator())->calculate($order['principal'], $tradeScenario, $feesConfigurations);

print_r($computations);