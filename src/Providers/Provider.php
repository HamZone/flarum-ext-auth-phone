<?php

namespace HamZone\AuthPhone\Providers;

use Flarum\Foundation\AbstractServiceProvider;
use HamZone\AuthPhone\Disk\Disk;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Filesystem\Factory;

class Provider extends AbstractServiceProvider {

    public function __construct(Container $container)
    {
        // $this->container->singleton(Disk::class, function (Container $container) {
            $filesystem = $container->make(Factory::class);
            app("log")->info("yes");
            $path = "aes-key.txt";
            $filesystem->put($path, "aes");

            // return new Disk($filesystem->disk('aes'));
        // });
    }
}