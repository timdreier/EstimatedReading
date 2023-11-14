<?php

$EM_CONF[$_EXTKEY] = [
        'title' => 'Estimated Reading',
        'description' => 'Counts words and sentences and calculates estimated reading for this.',
        'category' => 'services',
        'author' => 'Tim Dreier',
        'author_email' => 'hello@tim-dreier.de',
        'author_company' => 'Tim Dreier',
        'priority' => '',
        'module' => '',
        'state' => 'stable',
        'internal' => '',
        'uploadfolder' => false,
        'createDirs' => '',
        'clearCacheOnLoad' => 1,
        'version' => '1.0.0',
        'autoload' => [
            'psr-4' => [
                'TimDreier\\TdReadingTime\\' => 'Classes',
            ],
        ],
        'constraints' => [
                'depends' => [
                        'typo3' => '>=11.0.0',
                ],
                'conflicts' => [],
                'suggests' => [],
        ]
];
