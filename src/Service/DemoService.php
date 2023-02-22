<?php

namespace App\Service;

use App\SomeEnum;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class DemoService
{
    public function __construct(
        #[Autowire('%app.some_parameter%')]
        private readonly SomeEnum $enum,

        #[Autowire('%app.another_parameter%')]
        private readonly array $enums
    )
    {
        dd($this->enum, $this->enums);
    }
}