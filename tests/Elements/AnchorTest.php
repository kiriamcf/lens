<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Elements;

use Illuminate\Console\Command;
use Kiriamcf\Lens\Tests\TestCase;

final class CommandTest extends TestCase
{
    public function test_html_detection_works(): void
    {
        $this->artisan('lens', ['--default' => 'true', '--extensions' => 'html', '--folder' => './tests/Fixtures/Anchor'])
            ->assertExitCode(Command::FAILURE);
    }
}
