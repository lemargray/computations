<?php

return [
    [
        'label' => 'JCSD Fee',
        "minimum" => 0,
        'isSlidingScale' => 0,
        'feeTypeCode' => 'jcsd_fee',
        'negotiable' => 0,
        "class" => \App\FeeCalculators\FeeCalculator::class,
    ],
    [
        'label' => 'JCSD cess',
        "minimum" => 0,
        'isSlidingScale' => 0,
        'feeTypeCode' => 'jcsd_cess',
        'negotiable' => 0,
        "class" => \App\FeeCalculators\FeeCalculator::class,
    ],
    [
        'label' => 'Commission',
        "minimum" => 0,
        'isSlidingScale' => 1,
        'feeTypeCode' => 'equity_commission',
        'negotiable' => 0,
        "class" => \App\FeeCalculators\FeeCalculator::class,
    ],
    [
        'label' => 'GCT',
        "minimum" => 100,
        'isSlidingScale' => 0,
        'feeTypeCode' => 'gct',
        'negotiable' => 0,
        "class" => \App\FeeCalculators\GCTFeeCalculator::class,
    ],
];