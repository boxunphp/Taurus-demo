<?php
namespace Boxun\App\Web\Controller;

use Taurus\ControllerAbstract;
use Taurus\View\View;

abstract class Controller extends ControllerAbstract
{
    /**
     * View
     *
     * @var View
     */
    protected $view;

    abstract public function main();

    public function before()
    {
        $this->view = View::getInstance();
        $this->view->setRootPath(kernel()->getAppPath() . '/View');
    }

    public function view()
    {
        return $this->view;
    }
}