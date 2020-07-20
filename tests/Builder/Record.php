<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Record;
use PHPUnit\Framework\TestCase;

class RecordTest extends TestCase
{
    public function testRecord()
    {
        $expectedElement = '<record on-answered="false" aleg="true" bleg="true" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testRecordOnAnswered()
    {
        $expectedElement = '<record on-answered="true" aleg="true" bleg="true" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav", true);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testRecordAleg()
    {
        $expectedElement = '<record on-answered="false" aleg="false" bleg="true" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav", false, false);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testRecordBleg()
    {
        $expectedElement = '<record on-answered="false" aleg="true" bleg="false" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav", false, true, false);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testRecordAlegBleg()
    {
        $expectedElement = '<record on-answered="false" aleg="false" bleg="false" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav", false, false, false);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testRecordAll()
    {
        $expectedElement = '<record on-answered="true" aleg="false" bleg="false" name="my_recording.wav"/>';

        $node = new Record("my_recording.wav", true, false, false);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
