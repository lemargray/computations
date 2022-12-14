<?php

namespace App\FeeCalculators;

use App\Entities\Deal;

class FeeCalculator extends AbstractFeeCalculator
{
    protected function execute(Deal $deal, $feeConfig) : float
    {
        $fee = 0;

        foreach($this->rules as $rule)
        {
            $ruleEvaluator = new $rule($this->feeRepository, $deal, $deal->getPrincipal(), $feeConfig);

            if( $ruleEvaluator->shouldApply() )
            {
                $fee = $ruleEvaluator->apply();
                $feeName = $feeConfig['label'];
                $deal->setFee($feeName, $fee);
            }
        }
        
        return $fee;
    }
}