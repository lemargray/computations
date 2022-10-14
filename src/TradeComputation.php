<?php

namespace App;

use InvalidArgumentException;

class TradeComputation
{
    public function calculate($principal, $tradeScenario, $rules)
    {
        $computations = $this->getDefaultComputations($principal);
        
        $charges = $this->calculateCharges($principal, $tradeScenario, $rules);

        $computations = $charges + $computations;
        
        $computations['amountDue'] = $computations['principal'] + $computations['totalCharges'];
        
        return $computations;
    }

    protected function shouldApplyMininumAmount($rule, $fee)
    {
        return !empty($rule['minimum']) && abs($fee) < $rule['minimum'];
    }

    protected function isSlidingScale($flag)
    {
        return !empty($flag);
    }

    protected function getDefaultComputations($principal)
    {
        return [
            'principal' => $principal,
            'fees' => [],
            'totalCharges' => 0,
        ];
    }

    public function calculateCharges($principal, $tradeScenario, $rules)
    {
        $charges['totalCharges'] = 0;

        foreach($rules as $rule) {
            $rate = 0;
            $ruleEvaluator = new $rule['class']();
        
            if ( !($ruleEvaluator instanceof \App\Rules\ExecutableRuleInterface) )
            {
                throw new InvalidArgumentException($rule['class'] . ' is not an instance of ' . \App\Rules\ExecutableRuleInterface::class);
            }

            if ($this->isSlidingScale($rule['is_sliding_scale']))
            {
                //query db using principal value to get rate
                //apply rate to principal
                
                $rate = .02;
            }
            
            $fee = $ruleEvaluator->execute($principal, $tradeScenario['effect_on_holdings'], $rule, $rate);
            
            if ($this->shouldApplyMininumAmount($rule, $fee)) {
                $fee = $rule['minimum'];
            }
            
            $charges['fees'][$rule['label']] = $fee;
            $charges['totalCharges'] += $fee;
        }
        
        return $charges;
    }
}