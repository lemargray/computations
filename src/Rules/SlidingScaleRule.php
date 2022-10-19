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
                                            $this->amount, $this->deal->getTradeDate());

        $fee = 0;

        foreach($feeBands as $feeBand)
        {
            $principal = $feeBand['upperLimit'] <= $this->amount ? $feeBand['upperLimit'] : $this->amount;

            if ($feeBand['isPercentage'] == 1)
            {
                $fee += ($principal - $feeBand['lowerLimit'] + 1) 
                        * $feeBand['rateAmount'] 
                        * $this->tradeScenario['effectOnTotal'];
            } 
            else
            {
                $fee += $feeBand['rateAmount'] * $this->tradeScenario['effectOnTotal'];
            }
        }
        

        return $fee;
    }
}