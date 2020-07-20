<?php

use Apidaze\Builder\Nodes\Answer;
use Apidaze\Builder\Nodes\BaseNode;
use PHPUnit\Framework\TestCase;

class AnswerTest extends TestCase
{
    public function testAnswer()
    {
        $expectedElement = '<answer/>';

        $node = new Answer();
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
