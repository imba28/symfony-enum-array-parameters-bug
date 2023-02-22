<?php

namespace App\Controller;

use App\Service\DemoService;
use Symfony\Component\Routing\Annotation\Route;

class DemoController
{
    #[Route('/')]
    public function demoAction(DemoService $service)
    {
        // should not print "Warning: Undefined array key "app.another_parameter""
    }
}