<?php

declare(strict_types=1);

namespace Kiriamcf\Lens;

use Kiriamcf\Lens\Commands\LensCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class LensServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('lens')
            ->hasConfigFile()
            ->hasCommand(LensCommand::class);
    }
}
