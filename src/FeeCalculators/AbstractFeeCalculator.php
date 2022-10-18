<?php

namespace App\FeeCalculators;

use App\Entities\Deal;
use App\FeeCalculators\Interfaces\FeeCalculatorInterface;
use App\FeeRate;
use App\Repositories\Interfaces\FeeRepositoryInterface;

abstract class AbstractFeeCalculator
{
    const YES = 1;

    protected $feeRepository;
    protected $rules;

    public function __construct(FeeRepositoryInterface $feeRepository, array $rules)
    {
        $this->feeRepository = $feeRepository;
        $this->rules = $rules;
    }

    abstract protected function execute(Deal $deal, $feeConfig) : float;

    public function calculate(Deal $deal, $feeConfig)
    {
        $fee = 0;

        foreach($this->rules as $rule)
        {
            $ruleEvaluator = new $rule($this->feeRepository, $deal, $feeConfig);

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