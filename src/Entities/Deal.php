<?php

namespace App\Entities;

use App\Entities\FeeRate;

class Deal
{
    protected $principal;
    protected $tradeDate;
    protected $tradeScenario;
    protected $negotiatedRate;
    protected $feeConfigurations;
    protected $dealComputations;

    public function __construct($principal, $tradeDate, $tradeScenario, $feeConfigurations, FeeRate $negotiatedRate = null)
    {
        $this->principal = $principal;
        $this->tradeDate = $tradeDate;
        $this->tradeScenario = $tradeScenario;
        $this->negotiatedRate = $negotiatedRate;
        $this->feeConfigurations = $feeConfigurations;

        $this->dealComputations = [
            'principal' => $principal,
            'fees' => []
        ];
    }

    public function setFee($key, $value)
    {
        $this->dealComputations['fees'][$key] = $value;
    }

    public function getFee($key)
    {
        if (!array_key_exists($key, $this->dealComputations['fees']))
        {
            $this->setFee($key, 0);
        }

        return $this->dealComputations['fees'][$key];
    }

    public function getFeeConfigurations()
    {
        return $this->feeConfigurations;
    }

    public function getPrincipal() : float
    {
        return $this->principal;
    }

    public function getTradeDate()
    {
        return $this->tradeDate;
    }

    public function getTradeScenario()
    {
        return $this->tradeScenario;
    }

    public function getNegotiatedRate()
    {
        return $this->negotiatedRate;
    }

    public function shouldApplyNegotiatedRate()
    {
        return !empty($this->negotiatedRate);
    }
}