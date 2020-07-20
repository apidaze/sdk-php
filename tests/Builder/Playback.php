<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Playback;
use PHPUnit\Framework\TestCase;

class PlaybackTest extends TestCase
{
    public function testPlayback()
    {
        $expectedElement = '<playback>my_file.wav</playback>';

        $node = new Playback("my_file.wav");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
