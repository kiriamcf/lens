<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Elements;

use Kiriamcf\Lens\Tests\TestCase;
use Illuminate\Console\Command;

final class CommandTest extends TestCase
{
    public function test_html_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::SUCCESS);
    }
}