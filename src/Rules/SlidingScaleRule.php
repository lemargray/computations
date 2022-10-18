<?php

namespace App\Rules;

use App\Deal;
use App\Rules\Interfaces\RuleInterface;

class SlidingScaleRule extends BaseRule
{
    protected $feeBand;

    public function shouldApply(): bool
    {
        return $this->feeConfig['isSlidingScale'] == 1;
    }

    public function apply() : float
    {
        $feeBands = $this->feeRepository->getSlidingScaleFees($this->feeConfig['feeTypeCode'], 
                                            $this->deal->getPrincipal(), $this->deal->getTradeDate());

        $fee = 0;

        // print_r($feeBands);exit;

        foreach($feeBands as $feeBand)
        {
            $principal = $feeBand['upperLimit'] <= $this->deal->getPrincipal() ? $feeBand['upperLimit'] : $this->deal->getPrincipal();

            if ($feeBand['isPercentage'] == 1)
            {
                $fee += ($principal - $feeBand['lowerLimit'] + 1) 
                        * $feeBand['rateAmount'] 
                        * $this->deal->getTradeScenario()['effectOnTotal'];
            } 
            else
            {
                $fee += $feeBand['rateAmount'] * $this->deal->getTradeScenario()['effectOnTotal'];
            }
        }
        

        return $fee;
    }
}