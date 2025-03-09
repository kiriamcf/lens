<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Console;

use InvalidArgumentException;
use Illuminate\Support\Facades\Artisan;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Tests\TestCase;
use Kiriamcf\Lens\Enums\FileExtension;

final class CommandTest extends TestCase
{
    public function testArtisanRegisteredTheCommand(): void
    {
        $this->assertArrayHasKey('lens', Artisan::all());
    }

    public function testCommandAsksConfigurations(): void
    {
        $this->artisan('lens')
            ->expectsQuestion('What file extensions would you like to inspect?', [FileExtension::BLADE->value])
            ->expectsQuestion('What depth would you like to apply?', Depth::SHALLOW->value)
            ->assertExitCode(0);
    }

    public function testCommandCanIgnoreConfigurations(): void
    {
        $this->artisan('lens', ['--extensions' => 'blade,vue', '--depth' => 'deep'])
            ->assertExitCode(0);
    }

    public function testInvalidArgumentsAreDetected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->artisan('lens', ['--extensions' => 'bladee'])
            ->run();
    }
}