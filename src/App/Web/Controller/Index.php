<?php
namespace Boxun\App\Web\Controller;

class Index extends Controller
{
    public function main()
    {
        echo 'Index::main()';
        echo kernel()->getEnvironment();
        logger()->error('Index::main()');
    }
}