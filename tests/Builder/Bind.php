<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Bind;
use PHPUnit\Framework\TestCase;

class BindTest extends TestCase
{
    public function testBind()
    {
        $expectedElement = '<bind action="http://script">1</bind>';

        $node = new Bind("1", "http://script");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
