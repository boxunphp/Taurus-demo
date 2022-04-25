<?php
namespace Boxun\App\Web\Controller\Caption;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\Caption\AllStagesModel;

/**
 * 忽略
 */
class Discard extends Controller
{
    public function main()
    {
        $this->validateInputParams();
        $ids = $this->getIds();
        $AllStagesModel = AllStagesModel::getInstance();
        $data = $this->getData();
        $result = $AllStagesModel->update($ids, $data);
        if (!$result) {
            $this->response()->error(1, '忽略失败');
        }
        $this->response()->success();
    }

    protected function getData()
    {
        return [
            'status' => 5,
        ];
    }

    protected function getIds()
    {
        $id = intval($this->request()->post('id'));
        if ($id) {
            return [$id];
        }
        $ids = $this->request()->post('ids');
        return $ids;
    }

    protected function validateInputParams()
    {
        $id = intval($this->request()->post('id'));
        $ids = $this->request()->post('ids');
        if (empty($id) && empty($ids)) {
            $this->response()->error(1, '参数错误');
        }
    }
}