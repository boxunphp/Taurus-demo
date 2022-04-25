<?php

/**
 * 手动脚本 把关卡数据导入数据库
 */

use Boxun\Model\Caption\AllStagesModel;

require dirname(dirname(__DIR__)) . '/init.php';

$AllStagesModel = AllStagesModel::getInstance();

$type = 1; // Square
$rootDir = kernel()->getRootPath() . '/assets/data';
if(is_dir($rootDir)){
    $fd = opendir($rootDir);
    while (($dir = readdir($fd)) !== false) {
        if (in_array($dir, ['.', '..']) || !is_dir($rootDir .'/' . $dir)) {
            continue;
        }
        $dataDir = $rootDir . '/' . $dir . '/data';
        if (!is_dir($dataDir)) {
            continue;
        }
        $data = [];
        $dataFileFd = opendir($dataDir);
        while (($file = readdir($dataFileFd)) !== false) {
            $filepath = $dataDir .'/' . $file;
            if (in_array($file, ['.', '..']) || !is_file($filepath)) {
                continue;
            }
            $jsonInfo = file_get_contents($filepath);
            if (empty($jsonInfo)) {
                continue;
            }
            $info = json_decode($jsonInfo, true);
            if (empty($info)) {
                continue;
            }
            // $code = md5($type . '-' . $info['rows'] . '_' . $info['cols'] . '-' . json_encode($info['subset'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
            $itemInfo = [
                // 'code' => $code,
                'type' => $type, // Square
                'rows' => $info['rows'],
                'cols' => $info['cols'],
                'disable_points' => json_encode($info['subset'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'map_data' => json_encode($info['mapdata'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                'road' => json_encode($info['road'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            ];
            $data[] = $itemInfo;
        }
        closedir($dataFileFd);
        if ($data) {
            if ($AllStagesModel->insertMulti($data)) {
                echo $dir . "\tOK" . PHP_EOL; 
            } else {
                echo $dir . "\tFAIL" . PHP_EOL; 
            }
        }
    }
    closedir($fd);
}
