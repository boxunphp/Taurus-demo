<?php
namespace Boxun\App\Api\Controller\Caption;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\Caption\AllStagesModel;
use Boxun\Model\Caption\StagesModel;

class StageList extends Controller
{
    public function main()
    {
        $AllStagesModel = AllStagesModel::getInstance();
        $data = $AllStagesModel->getList(1, 0, ['type' => 1, 'status' => 1], [], ['level' => 'ASC', 'id' => 'ASC']);
        $this->response()->success($this->formatData($data));
    }

    protected function formatData($data)
    {
        $result = [];
        foreach($data as $key => $info) {
            $result[] = [
                'id' => (int)$info['id'],
                'type' => (int)$info['type'],
                'stage' => $key + 1,
                'map_data' => json_decode($info['map_data'], true),
            ];
        }
        return $result;
    }

    // public function main()
    // {
    //     $StagesModel = StagesModel::getInstance();
    //     $data = $StagesModel->getList(1, 0, ['type' => 1], [], ['stage' => 'ASC']);
    //     $this->response()->success($this->formatData($data));
    // }

    // protected function formatData($data)
    // {
    //     foreach($data as &$info) {
    //         $info['id'] = (int)$info['id'];
    //         $info['type'] = (int)$info['type'];
    //         $info['stage'] = (int)$info['stage'];
    //         $info['map_data'] = json_decode($info['map_data'], true);
    //     }
    //     return $data;
    // }
}