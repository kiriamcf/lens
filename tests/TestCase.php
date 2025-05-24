<?php

namespace Kiriamcf\Lens\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Kiriamcf\Lens\LensServiceProvider;
use Kiriamcf\Lens\Services\Displayer;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public Displayer $displayer;

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Kiriamcf\\Lens\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        $this->displayer = app(Displayer::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            LensServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
