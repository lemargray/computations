<?php

require 'vendor/autoload.php';

use App\Entities\Deal;
use App\Entities\FeeRate;
use App\Repositories\FeeRepository;
use App\Rules\RuleGCT;
use App\TradeComputationCalculator;

$feesConfigurations = require __DIR__ . '/src/data/CalculationTypes.php';
$order              = require __DIR__ . '/src/data/Order.php';
$tradeScenario      = require __DIR__ . '/src/data/TradeScenario.php';
$rules              = require __DIR__ . '/src/configs/rules.php';

$negotiatedRate     = new FeeRate($order['negotiatedRate'], !empty($order['isPercentage']));
$feeRepository      = new FeeRepository();
$deal               = new Deal(
                            $order['principal'], 
                            $order['orderDate'], 
                            $tradeScenario, 
                            $feesConfigurations, 
                            $negotiatedRate
                        );
                        
$computations = (new TradeComputationCalculator($feeRepository, $rules['equityRules']))->calculate($deal);

print_r($computations);

