<?php
/**
 * 定时脚本&手动脚本 DEMO
 */
require __DIR__ .'/init.php';

$UserModel = \Boxun\Model\User\UserModel::getInstance();
$list = $UserModel->getList(1, 0);
print_r($list);
echo PHP_EOL;