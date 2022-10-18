<?php

namespace App\Rules;

use App\Entities\Deal;
use App\Repositories\Interfaces\FeeRepositoryInterface;
use App\Rules\Interfaces\RuleInterface;

abstract class BaseRule implements RuleInterface
{
    protected $feeRepository;
    protected $deal;
    protected $feeConfig;

    public function __construct(FeeRepositoryInterface $feeRepository, Deal $deal, $feeConfig)
    {
        $this->feeRepository = $feeRepository;
        $this->deal = $deal;
        $this->feeConfig = $feeConfig;
    }

    abstract public function shouldApply() : bool;
    abstract public function apply() : float;
}