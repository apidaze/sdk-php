<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Work;
use PHPUnit\Framework\TestCase;

class WorkTest extends TestCase
{
    public function testWork()
    {
        $expectedElement = '<work/>';

        $node = new Work();
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
