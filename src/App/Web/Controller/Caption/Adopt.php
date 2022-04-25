<?php
namespace Boxun\App\Web\Controller\Caption;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\Caption\AllStagesModel;

/**
 * 采用
 */
class Adopt extends Controller
{
    public function main()
    {
        $this->validateInputParams();
        $id = intval($this->request()->post('id'));
        $AllStagesModel = AllStagesModel::getInstance();
        $info = $AllStagesModel->getOne($id);
        if (!$info) {
            $this->response()->error(1, '信息不存在');
        }
        $data = $this->getData();
        $result = $AllStagesModel->update($id, $data);
        if (!$result) {
            $this->response()->error(1, '忽略失败');
        }
        $this->response()->success();
    }

    protected function getData()
    {
        return [
            'status' => 1,
            'level' => intval($this->request()->post('level')),
        ];
    }

    protected function validateInputParams()
    {
        $id = intval($this->request()->post('id'));
        if (empty($id)) {
            $this->response()->error(1, '参数错误');
        }
        $level = intval($this->request()->post('level'));
        if ($level < 1 || $level > 10) {
            $this->response()->error(1, '参数错误');
        }
    }
}