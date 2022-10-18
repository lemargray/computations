<?php

return [
    'equityRules' => [
        \App\Rules\MinimumRule::class,
        \App\Rules\PercentageRule::class,
        \App\Rules\FixedAmountRule::class,
        \App\Rules\SlidingScaleRule::class,
    ]
];