<?php
namespace Boxun\App\Web\Controller\User;

use Boxun\App\Web\Controller\Controller;
use Boxun\Model\User\UserModel;
use Boxun\Store\User\UserCounter;

class GetList extends Controller
{
    public function main()
    {
        $UserModel = UserModel::getInstance();
        $list = $UserModel->getList(1, 0);

        $this->view()->assign('list', $list);
        $this->view()->render('User/GetList');
    }
}