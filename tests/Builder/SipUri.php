<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\SipUri;
use PHPUnit\Framework\TestCase;

class SipUriTest extends TestCase
{
    public function testSipUri()
    {
        $expectedElement = '<sipuri>sip://uri</sipuri>';

        $node = new SipUri("sip://uri");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
