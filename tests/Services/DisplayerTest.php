<?php

declare(strict_types=1);

namespace Kiriamcf\Lens\Tests\Services;

use Kiriamcf\Lens\Services\Displayer;
use Kiriamcf\Lens\Tests\TestCase;
use Kiriamcf\Lens\ValueObjects\Log;
use Symfony\Component\Console\Output\BufferedOutput;

final class DisplayerTest extends TestCase
{
    public function test_class_is_bound_to_container(): void
    {
        $this->assertTrue(app()->bound(Displayer::class));
    }

    public function test_output_is_console(): void
    {
        $displayer = app(Displayer::class);

        $this->assertEquals($displayer->output(), new BufferedOutput);
    }

    public function test_can_dump_logs(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute'],
            recommendedAttributes: ['attribute']
        );

        $displayer->dump(collect([$log]));

        $this->assertNotEmpty($displayer->output()->fetch());
    }

    public function test_dumped_log_contains_filename(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute'],
            recommendedAttributes: ['attribute']
        );

        $displayer->dump(collect([$log]));

        $this->assertStringContainsString('/path/to/file', $displayer->output()->fetch());
    }

    public function test_dumped_log_contains_line(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute'],
            recommendedAttributes: ['attribute']
        );

        $displayer->dump(collect([$log]));

        $this->assertStringContainsString('Line: 1', $displayer->output()->fetch());
    }

    public function test_dumped_log_contains_element(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute'],
            recommendedAttributes: ['attribute']
        );

        $displayer->dump(collect([$log]));

        $this->assertStringContainsString('Element: element', $displayer->output()->fetch());
    }

    public function test_dumped_log_contains_missing_attributes(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute1, attribute2'],
            recommendedAttributes: ['attribute3, attribute4']
        );

        $displayer->dump(collect([$log]));

        $this->assertStringContainsString('Missing attributes: attribute1, attribute2', $displayer->output()->fetch());
    }

    public function test_dumped_log_contains_recommended_attributes(): void
    {
        $displayer = app(Displayer::class);

        $log = new Log(
            path: '/path/to/file',
            line: 1,
            element: 'element',
            missingAttributes: ['attribute1, attribute2'],
            recommendedAttributes: ['attribute3, attribute4']
        );

        $displayer->dump(collect([$log]));

        $this->assertStringContainsString('Recommended attributes: attribute3, attribute4', $displayer->output()->fetch());
    }
}
