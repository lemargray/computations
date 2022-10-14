<?php

return [
    [
        'label' => 'GCT',
        "minimum" => 100,
        'is_sliding_scale' => 0,
        "class" => \App\FeeCalculators\EquityOrderFeeCalculators\GCTFeeCalculator::class,
    ],
    [
        'label' => 'JCSD Fee',
        "minimum" => 300,
        'is_sliding_scale' => 0,
        "class"=> \App\FeeCalculators\EquityOrderFeeCalculators\JCSDFeeCalculator::class
    ],
    [
        'label' => 'Commission',
        "minimum" => 300,
        'is_sliding_scale' => 1,
        'fee_type_code' => 'equity_commission',
        "class"=> \App\FeeCalculators\EquityOrderFeeCalculators\CommissionFeeCalculator::class
    ]
];