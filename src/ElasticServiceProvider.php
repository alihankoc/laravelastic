<?php

namespace AlihanKoc\Laravelastic;

use AlihanKoc\Laravelastic\Contracts\Elastic;
use AlihanKoc\Laravelastic\Repositories\ElasticRepository;
use Illuminate\Support\ServiceProvider;

class ElasticServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'elastic');

        $this->app->bind(
            Elastic::class,
            ElasticRepository::class
        );

    }

    protected function configPath()
    {
        return __DIR__ . '/../config/elastic.php';
    }

}
