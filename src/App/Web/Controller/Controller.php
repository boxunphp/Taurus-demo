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

    final public function view()
    {
        return $this->view;
    }

    /**
     * 分页的当前页码
     *
     * @return integer
     */
    final public function page()
    {
        $page = (int)$this->request()->input('page');
        if ($page < 1) {
            $page = 1;
        }
        return $page;
    }

    /**
     * 分页的每页记录数
     *
     * @param integer $default
     * @param integer $max
     * @return integer
     */
    final public function count($default = 20, $max = 500)
    {
        $count = (int)$this->request()->input('count');
        if ($count <= 0) {
            $count = $default;
        }
        if ($max > 0 && $count > $max) {
            $count = $max;
        }
        return $count;
    }
}