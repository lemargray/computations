<?php

return [
    [
        'label' => 'GCT',
        "minimum" => 100,
        'is_sliding_scale' => 0,
        "class" => \App\Rules\RuleGCT::class,
    ],
    [
        'label' => 'JCSD Fee',
        "minimum" => 300,
        'is_sliding_scale' => 0,
        "class"=> \App\Rules\RuleJCSDFee::class
    ],
    // [
    //     'label' => 'Commission',
    //     "minimum" => 300,
    //     'is_sliding_scale' => 1,
    //     'fee_type_code' => 'equity_commission',
    //     "class"=> \App\Rules\RuleCommission::class
    // ]
];