<?php
namespace Boxun\App\Web\Controller\TestMaker;

use Boxun\App\Web\Controller\Controller;

class Practice extends Controller
{
    public function main()
    {
        $this->view()->render('TestMaker/Practice');
    }
}