<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Intercept;
use PHPUnit\Framework\TestCase;

class InterceptTest extends TestCase
{
    public function testIntercept()
    {
        $expectedElement = '<intercept>uuid</intercept>';

        $node = new Intercept("uuid");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
