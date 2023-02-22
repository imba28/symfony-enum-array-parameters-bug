<?php

use App\SomeEnum;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $container->parameters()
        ->set('app.some_parameter', SomeEnum::Foo)
        ->set('app.another_parameter', [SomeEnum::Foo, SomeEnum::Bar]);
};