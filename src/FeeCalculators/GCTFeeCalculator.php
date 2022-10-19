<?php

namespace App\FeeCalculators;

use App\Entities\Deal;

class GCTFeeCalculator extends AbstractFeeCalculator
{
    protected function execute(Deal $deal, $feeConfig) : float
    {
        $fee = 0;

        foreach($this->rules as $rule)
        {
            $totalCharges = $deal->getFee('totalCharges');
            $ruleEvaluator = new $rule($this->feeRepository, $deal, $totalCharges, $feeConfig);

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