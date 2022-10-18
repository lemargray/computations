<?php

namespace App\Rules;

use App\Deal;
use App\Rules\Interfaces\RuleInterface;

class PercentageRule extends BaseRule
{
    protected $feeBand;

    public function shouldApply(): bool
    {
        $this->feeBand = $this->feeRepository->getDefaultFee($this->feeConfig['feeTypeCode'], $this->deal->getTradeDate());

        if ($this->feeConfig['negotiable'] == 1) {
            return $this->deal->getNegotiatedRate()->isPercentage() && $this->feeConfig['isSlidingScale'] == 0;
        }
        
        return $this->feeBand['isPercentage'] == 1 && $this->feeConfig['isSlidingScale'] == 0;
    }

    public function apply() : float
    {
        $feeRateAmount = $this->feeConfig['negotiable'] == 1 ?
                $this->deal->getNegotiatedRate()->getAmount() :
                $this->feeBand['rateAmount'];

        echo PHP_EOL . $this->feeConfig['label'] . ' Fee Rate Amount: ' . $feeRateAmount . PHP_EOL;

        return $this->deal->getPrincipal()
            * $feeRateAmount 
            * $this->deal->getTradeScenario()['effectOnTotal'];
    }
}