<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use InvalidArgumentException;
use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Enums\FileExtension;
use Kiriamcf\Lens\Tests\TestCase;

final class CommandTest extends TestCase
{
    public function test_artisan_registered_the_command(): void
    {
        $this->assertArrayHasKey('lens', Artisan::all());
    }

    public function test_command_asks_configurations(): void
    {
        $this->artisan('lens')
            ->expectsQuestion('What file extensions would you like to inspect?', [FileExtension::BLADE->value])
            ->expectsQuestion('What depth would you like to apply?', Depth::SHALLOW->value)
            ->assertExitCode(Command::SUCCESS);
    }

    public function test_command_can_ignore_configurations(): void
    {
        $this->artisan('lens', ['--extensions' => 'blade,vue', '--depth' => 'deep'])
            ->assertExitCode(Command::SUCCESS);
    }

    public function test_invalid_arguments_are_detected(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->artisan('lens', ['--extensions' => 'bladee'])
            ->run()
            ->assertExitCode(Command::FAILURE);
    }
}
