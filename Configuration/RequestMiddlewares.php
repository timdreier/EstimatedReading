<?php
return [
    'frontend' => [
        'estimate_reading' => [
            'target' => TimDreier\TdReadingTime\Middleware\EstimateReading::class,
            'disabled' => false,
            'before' => [],
            'after' => [
                'typo3/cms-frontend/output-compression',
            ],
        ],
    ],
];
