<?php
namespace Boxun\App\Api\Controller\User;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\User\UserModel;
use Boxun\Store\User\UserCounter;

class GetList extends Controller
{
    public function main()
    {
        $UserModel = UserModel::getInstance();
        $list = $UserModel->getList(1, 0);
        $data = [
            'list' => $list,
            'counter' => UserCounter::getInstance()->incr('test'),
            'info' => $UserModel->getOne(1),
        ];

        $this->response()->success($data);
    }
}