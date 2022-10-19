<?php

return [
    [
        'lowerLimit' => 1,
        'upperLimit' => 1000000000000,
        'feeTypeCode' => 'equity_commission',
        'rateAmount' => (0.3 / 100),
        'isPercentage' => 1,
        'effectiveDate' => '2020-01-01'
    ],
    // [
    //     'lowerLimit' => 10001,
    //     'upperLimit' => 100000,
    //     'feeTypeCode' => 'equity_commission',
    //     'rateAmount' => 0.015,
    //     'isPercentage' => 1,
    //     'effectiveDate' => '2020-01-01'
    // ],
    // [
    //     'lowerLimit' => 100001,
    //     'upperLimit' => 1000000,
    //     'feeTypeCode' => 'equity_commission',
    //     'rateAmount' => 0.015,
    //     'isPercentage' => 1,
    //     'effectiveDate' => '2020-01-01'
    // ],
    // [
    //     'lowerLimit' => 1000001,
    //     'upperLimit' => 10000000000,
    //     'feeTypeCode' => 'equity_commission',
    //     'rateAmount' => 0.015,
    //     'isPercentage' => 1,
    //     'effectiveDate' => '2020-01-01'
    // ],
    [
        'lowerLimit' => 0,
        'upperLimit' => 10000,
        'feeTypeCode' => 'gct',
        'rateAmount' => (15 / 100),
        'isPercentage' => 1,
        'effectiveDate' => '2020-01-01'
    ],
    [
        'lowerLimit' => 0,
        'upperLimit' => 10000,
        'feeTypeCode' => 'jcsd_fee',
        'rateAmount' => 0.032,
        'isPercentage' => 1,
        'effectiveDate' => '2020-01-01'
    ],
    [
        'lowerLimit' => 0,
        'upperLimit' => 100000000000000,
        'feeTypeCode' => 'jcsd_cess',
        'rateAmount' => 10000,
        'isPercentage' => 0,
        'effectiveDate' => '2020-01-01'
    ]
];