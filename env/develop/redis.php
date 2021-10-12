<?php
/**
 * Redis配置
 */
return [
    'master' => [
        'host' => 'redis-5.0-6379',
        'port' => 6379,
        'timeout' => 1,
        'pconennt' => 1,
        'password' => '',
        'read_timeout' => 1,
    ],
    'slaves' => [
        [
            'host' => 'redis-5.0-6379',
            'port' => 6379,
            'timeout' => 1,
            'pconennt' => 1,
            'password' => '',
            'read_timeout' => 1,
        ]
    ]
];