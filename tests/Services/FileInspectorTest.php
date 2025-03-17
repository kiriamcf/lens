<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Services;

use Kiriamcf\Lens\Enums\Depth;
use Kiriamcf\Lens\Tests\TestCase;
use Kiriamcf\Lens\Services\FileInspector;
use Kiriamcf\Lens\ValueObjects\Log;
use SplFileInfo;

final class FileInspectorTest extends TestCase
{
    public function test_it_can_load_file_contents(): void
    {
        $file = new SplFileInfo(__DIR__ . '/../Fixtures/dummy.html');

        $inspector = new FileInspector($file, Depth::SHALLOW);

        $this->assertNotNull($inspector->getDom()->documentElement);
    }

    public function test_it_checks_for_html_elements(): void
    {
        $file = new SplFileInfo(__DIR__ . '/../Fixtures/dummy.html');

        $inspector = new FileInspector($file, Depth::SHALLOW);

        $inspector->analyze();

        $logs = $inspector->getLogs();

        $this->assertNotEmpty($logs);    
    }

    public function test_logs_generated_are_valueObjects(): void
    {
        $file = new SplFileInfo(__DIR__ . '/../Fixtures/dummy.html');

        $inspector = new FileInspector($file, Depth::SHALLOW);

        $inspector->analyze();

        $logs = $inspector->getLogs();

        $this->assertNotEmpty($logs);
        $this->assertTrue($logs->first() instanceof Log);
    }
}