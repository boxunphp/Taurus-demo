<?php

/**
 * 手动脚本 把关卡数据导入数据库
 */

use Boxun\Model\Caption\AllStagesModel;

require dirname(dirname(__DIR__)) . '/init.php';

$AllStagesModel = AllStagesModel::getInstance();
$filter = [
    'type' => 1,
    'status' => 0,
];
$total = $AllStagesModel->getTotal($filter);
$count = 1000;
$pages = ceil($total / $count);
for ($page = 1; $page <= $pages; $page++) {
    $list = $AllStagesModel->getList($page, $count, $filter, [], ['id' => 'ASC']);
    if (empty($list)) {
        break;
    }
    print((($page - 1) * $count) . "\n");
    $updateData = [];
    foreach($list as $item) {
        $mapData = json_decode($item['map_data'], true);
        $road = json_decode($item['road'], true);
        if (edge_point_is_disabled($mapData)) {
            print_map_data($mapData);
            $updateData[] = [
                'id' => $item['id'],
                'status' => 5,
            ];
            continue;
        }

        if (edge_point_is_start($road[0], $mapData)) {
            $mapData[$road[0][0]][$road[0][1]] = 2;
            print_map_data($mapData);
            $updateData[] = [
                'id' => $item['id'],
                'status' => 5,
            ];
        }
    }
    if ($updateData) {
        $result = $AllStagesModel->updateMulti($updateData);
        if (!$result) {
            print("\更新失败\n");
        }
    }
}

/**
 * 边缘（单边）的为起始点
 *
 * @param array $mapData
 * @return boolean
 */
function edge_point_is_start($point, $mapData) 
{
    $rows = count($mapData);
    $cols = count($mapData[0]);
    // 标记起始点
    $mapData[$point[0]][$point[1]] = 2;
    // 首行
    if (is_edge_point($mapData[0])) {
        return true;
    }
    // 尾行
    if (is_edge_point($mapData[$rows - 1])) {
        return true;
    }
    // 首列
    if (is_edge_point(array_column($mapData, 0))) {
        return true;
    }
    // 尾列
    if (is_edge_point(array_column($mapData, $cols - 1))) {
        return true;
    }
    return false;
}

/**
 * 是否边缘的起始点
 *
 * @param array $data
 * @return boolean
 */
function is_edge_point($data) 
{
    // 从左到右
    $str = trim(implode('', $data), '1');
    if (empty($str)) {
        return false;
    }
    if ($str[0] == 2 || $str[strlen($str) - 1] == 2) {
        return true;
    }
    return false;
}

/**
 * 边缘（单边）的点是否禁用的
 *
 * @param array $mapData
 * @return boolean
 */
function edge_point_is_disabled($mapData) 
{
    $rows = count($mapData);
    $cols = count($mapData[0]);
    // 首行
    if (is_all_disabled($mapData[0])) {
        return true;
    }
    // 尾行
    if (is_all_disabled($mapData[$rows - 1])) {
        return true;
    }
    // 首列
    if (is_all_disabled(array_column($mapData, 0))) {
        return true;
    }
    // 尾列
    if (is_all_disabled(array_column($mapData, $cols - 1))) {
        return true;
    }
    return false;
}

/**
 * 所有的点是否都是禁用的
 *
 * @param array $data
 * @return boolean
 */
function is_all_disabled($data)
{
    foreach($data as $value) {
        if (!$value) {
            return false;
        }
    }
    return true;
}

/**
 * 打印地图
 *
 * @param array $mapData
 * @return void
 */
function print_map_data($mapData)
{
    $rows = count($mapData);
    $cols = count($mapData[0]);
    print("=================\n");
    for ($row = $rows - 1; $row >= 0; $row--) {
        for ($col = 0; $col < $cols; $col++) {
            print($mapData[$row][$col] . "  ");
        }
        print("\n");
    }
    print("=================\n");
}