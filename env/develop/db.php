<?php

/**
 * 数据库配置
 */
return [
    'master' => [
        'host' => 'mysql-5.7-3306',
        'port' => 3306,
        'username' => 'root',
        'password' => '123456',
        'dbname' => 'test',
        'connect_timeout' => 1,
        'timeout' => 1,
        'is_persistent' => 1,
        'charset' => 'utf8mb4',
    ],
    'slaves' => [
        [
            'host' => 'mysql-5.7-3306',
            'port' => 3306,
            'username' => 'root',
            'password' => '123456',
            'dbname' => 'test',
            'connect_timeout' => 1,
            'timeout' => 1,
            'is_persistent' => 1,
            'charset' => 'utf8mb4',
        ]
    ]
];
