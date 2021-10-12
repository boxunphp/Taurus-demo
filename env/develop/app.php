<?php
/**
 * 项目的环境配置，可根据不同环境配置不同信息
 */
return [
    'error_reporting' => E_ALL,
    'display_errors' => true,
    'timezone' => 'Asia/Shanghai',
    'log_level' => \Taurus\Logger\Logger::NOTICE,
    'log_save_path' => '/www/privdata/examples.com/logs'
];