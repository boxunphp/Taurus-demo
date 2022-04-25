<?php
namespace Boxun\App\Api\Controller;

class Index extends Controller
{
    public function main()
    {
        $this->response()->success(['data' => 'DATA']);
    }
}