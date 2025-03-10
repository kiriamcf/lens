<?php

declare(strict_types=1);

namespace Kiriamcf\Lens;

use Kiriamcf\Lens\Commands\LensCommand;
use Kiriamcf\Lens\Services\Displayer;
use Laravel\Prompts\Output\ConsoleOutput;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Symfony\Component\Console\Output\BufferedOutput;

final class LensServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('lens')
            ->hasConfigFile()
            ->hasCommand(LensCommand::class);
    }

    /**
     * Register the package services.
     */
    public function packageRegistered(): void
    {
        $this->app->singleton(Displayer::class, function ($app) {
            $output = app()->environment('testing') 
                ? new BufferedOutput() 
                : new ConsoleOutput();
        
            return new Displayer($output);
        });
    }
}
