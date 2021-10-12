<?php
$rootPath = dirname(dirname(__DIR__));
$vendor = require($rootPath . '/vendor/autoload.php');
$Kernel = \Taurus\Kernel::getInstance();
$Kernel->main($rootPath, 'Api');