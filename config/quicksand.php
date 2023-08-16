<?php

return [
    // Days before deleting soft deleted content
    'days' => 30,

    // Whether to log the number of soft deleted records
    'log' => false,

    // List of models and/or pivot tables to run Quicksand on
    'deletables' => [
        // \App\Example::class,

        // App\Example::class => [
        //     'days' => '30' // override default 'days'
        // ]
        'models' => [
            Department::class => [
                'days' => '1' // per-model days setting override
            ]
        ]

        // 'example_pivot', 

        // 'example_pivot' => 
        //     'days' => '30' // override default 'days'
        // ]
    ],
];
