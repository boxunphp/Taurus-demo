<?php
namespace Boxun\App\Web\Controller\User;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\User\UserModel;
use Boxun\Store\User\UserCounter;

class GetDetail extends Controller
{
    public function main()
    {
        $id = intval($this->request()->query('id'));
        $UserModel = UserModel::getInstance();
        $info = $UserModel->getOne($id);

        // redis
        $UserCounter = UserCounter::getInstance();
        $counterKey = 'counter:' . $id;
        $UserCounter->incr($counterKey);

        $this->view()->assign('info', $info);
        $this->view()->assign('counter', $UserCounter->get($counterKey));
        $this->view()->render('User/GetDetail');
    }
}