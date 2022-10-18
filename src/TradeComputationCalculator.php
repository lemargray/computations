<?php

namespace App;

use App\Entities\Deal;
use App\Repositories\Interfaces\FeeRepositoryInterface;
use FeeCalculatorTrait;
use InvalidArgumentException;

class TradeComputationCalculator
{
    // use FeeCalculatorTrait;
    protected $feeRepository;
    protected $rules;

    public function __construct(FeeRepositoryInterface $feeRepository, $rules)
    {
        $this->feeRepository = $feeRepository;
        $this->rules = $rules;
    }

    public function calculate(Deal $deal) : array
    {
        $charges = $this->calculateCharges($deal);
        
        $amountDue = $deal->getPrincipal() + $charges['totalCharges'];
        
        return [
            'princial' => $deal->getPrincipal(),
            'fees' => $charges['fees'],
            'totalCharges' => $charges['totalCharges'],
            'amountDue' => $amountDue
        ];
    }

    public function calculateCharges(Deal $deal)
    {
        $charges['totalCharges'] = 0;
        $feeConfigs = $deal->getFeeConfigurations();

        foreach($feeConfigs as $feeConfig) {
            /** @var \App\FeeCalculators\AbstractFeeCalculator */
            $feeCalculator = new $feeConfig['class']($this->feeRepository, $this->rules);
        
            // $this->ifRuleIsNotAnExecutableRuleThrowEexception($feeCalculator, $feeConfig['class']);
            
            $fee = $feeCalculator->calculate($deal, $feeConfig);
            
            $charges['fees'][$feeConfig['label']] = $fee;
            $charges['totalCharges'] += $fee;
        }
        
        return $charges;
    }

    protected function ifRuleIsNotAnExecutableRuleThrowEexception($rule, $class)
    {
        if ( !($rule instanceof \App\FeeCalculators\Interfaces\FeeCalculatorInterface) )
        {
            throw new InvalidArgumentException($class . ' is not an instance of ' . \App\FeeCalculators\Interfaces\FeeCalculatorInterface::class);
        }
    }
}