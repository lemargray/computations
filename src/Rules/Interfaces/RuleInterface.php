<?php

namespace App\Rules\Interfaces;

use App\Entities\Deal;
use App\Repositories\Interfaces\FeeRepositoryInterface;

interface RuleInterface
{
    public function  __construct(FeeRepositoryInterface $feeRepository, Deal $deal, $amount, $feeConfig);
    public function shouldApply() : bool;
    public function apply() : float;
}