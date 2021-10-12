<?php
$rootPath = dirname(__DIR__);
$vendor = require(dirname($rootPath) . '/vendor/autoload.php');
$vendor->addPsr4('Boxun\\', $rootPath . '/src/');

$Kernel = \Taurus\Kernel::getInstance();
$Kernel->console($rootPath);