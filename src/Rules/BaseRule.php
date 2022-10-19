<?php

namespace App\Rules;

use App\Entities\Deal;
use App\Repositories\Interfaces\FeeRepositoryInterface;
use App\Rules\Interfaces\RuleInterface;

abstract class BaseRule implements RuleInterface
{
    protected $feeRepository;
    protected $deal;
    protected $tradeScenario;
    protected $feeConfig;

    public function __construct(FeeRepositoryInterface $feeRepository, Deal $deal, $amount, $feeConfig)
    {
        $this->feeRepository = $feeRepository;
        $this->amount = $amount;
        $this->deal = $deal;
        $this->tradeScenario = $deal->getTradeScenario();
        $this->feeConfig = $feeConfig;
    }

    abstract public function shouldApply() : bool;
    abstract public function apply() : float;
}