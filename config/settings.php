<?php
return [

    'max_system_transaction' => env('MAX_SYSTEM_TRANSACTION',500000000),
    'min_system_transaction' => env('MIN_SYSTEM_TRANSACTION',10000),
    'system_commission' => env('SYSTEM_COMMISSION',5000),
    'providers' => [
        'kavenegar' => [
            'name' => 'kavenegar',
            'sender' => '2000500600400'
        ],
        'ghasedak' => [
            'name' => 'ghasedaksms',
            'sender' => '2000500600400'
        ]
    ]
];
