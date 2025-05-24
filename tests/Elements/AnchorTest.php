<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Elements;

use Illuminate\Console\Command;
use Kiriamcf\Lens\Tests\TestCase;

final class AnchorTest extends TestCase
{
    public function test_html_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(2, $this->displayer->dumps);

        $this->displayer->reset();

        $this->artisan('lens', ['--depth' => 'deep', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(3, $this->displayer->dumps);
    }

    public function test_blade_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'blade', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(2, $this->displayer->dumps);

        $this->displayer->reset();

        $this->artisan('lens', ['--depth' => 'deep', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(3, $this->displayer->dumps);
    }

    public function test_jsx_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'jsx', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(2, $this->displayer->dumps);

        $this->displayer->reset();

        $this->artisan('lens', ['--depth' => 'deep', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(3, $this->displayer->dumps);
    }

    public function test_tsx_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'tsx', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(2, $this->displayer->dumps);

        $this->displayer->reset();

        $this->artisan('lens', ['--depth' => 'deep', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(3, $this->displayer->dumps);
    }

    public function test_vue_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'vue', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(2, $this->displayer->dumps);

        $this->displayer->reset();

        $this->artisan('lens', ['--depth' => 'deep', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);

        $this->assertEquals(3, $this->displayer->dumps);
    }
}
