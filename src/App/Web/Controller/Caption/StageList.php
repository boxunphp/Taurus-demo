<?php

namespace Boxun\App\Web\Controller\Caption;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\Caption\AllStagesModel;

class StageList extends Controller
{
    public function main()
    {
        $count = $this->count(200);
        $filter = $this->filter();
        $AllStagesModel = AllStagesModel::getInstance();
        $list = $AllStagesModel->getList(1, $count, $filter, [], ['id' => 'ASC']);
        if (!empty($list) && count($list) >= $count) {
            $end = end($list);
            $lastId = $end['id'];
        } else {
            if (is_null($this->request()->get('last_id'))) {
                $lastId = 0;
            } else {
                $lastId = -1;
            }
        }
        $this->view()->assign('list', $this->formatList($list));
        $this->view()->assign('lastId', $lastId);
        $this->view()->render('Caption/StageList');
    }

    protected function formatList($list)
    {
        $result = [];
        foreach ($list as $item) {
            $item['disable_points'] = json_decode($item['disable_points'], true);
            $item['map_data'] = json_decode($item['map_data'], true);
            $item['road'] = json_decode($item['road'], true);
            $result[] = $item;
        }
        return $result;
    }

    protected function filter()
    {
        $lastId = intval($this->request()->get('last_id'));
        $filter = [
            'type' => 1,
            'status' => 0,
            'last_id' => $lastId,
        ];
        $this->view()->assign('prevLastId', $lastId);
        return $filter;
    }
}
