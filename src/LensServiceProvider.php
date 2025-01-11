<?php

namespace Kiriamcf\Lens;

use Kiriamcf\Lens\Commands\LensCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LensServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('lens')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_lens_table')
            ->hasCommand(LensCommand::class);
    }
}
