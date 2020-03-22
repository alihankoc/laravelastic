<?php

namespace AlihanKoc\Elastic;

use AlihanKoc\Elastic\Contracts\Elastic;
use AlihanKoc\Elastic\Repositories\ElasticRepository;
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
