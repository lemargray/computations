<?php

namespace App;

use InvalidArgumentException;

class TradeComputationCalculator implements TradeComputationCalculatorInterface
{
    public function calculate($principal, $tradeScenario, $rules) : array
    {
        $charges = $this->calculateCharges($principal, $tradeScenario, $rules);
        
        $amountDue = $principal + $charges['totalCharges'];
        
        return [
            'princial' => $principal,
            'fees' => $charges['fees'],
            'totalCharges' => $charges['totalCharges'],
            'amountDue' => $amountDue
        ];
    }

    protected function shouldApplyMininumAmount($rule, $fee)
    {
        return !empty($rule['minimum']) && abs($fee) < $rule['minimum'];
    }

    protected function isSlidingScale($flag)
    {
        return !empty($flag);
    }

    public function calculateCharges($principal, $tradeScenario, $feesConfigurations)
    {
        $charges['totalCharges'] = 0;

        foreach($feesConfigurations as $feeConfig) {
            $rate = 0;
            $feeCalculator = new $feeConfig['class']();
        
            $this->ifRuleIsNotAnExecutableRuleThrowEexception($feeCalculator, $feeConfig['class']);

            if ($this->isSlidingScale($feeConfig['is_sliding_scale']))
            {
                //query db using principal value to get rate
                //apply rate to principal
                
                $rate = .02;
            }
            
            $fee = $feeCalculator->execute($principal, $tradeScenario['effect_on_holdings'], $feeConfig, $rate);
            
            if ($this->shouldApplyMininumAmount($feeConfig, $fee)) {
                $fee = $feeConfig['minimum'];
            }
            
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