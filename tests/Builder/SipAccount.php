<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\SipAccount;
use PHPUnit\Framework\TestCase;

class SipAccountTest extends TestCase
{
    public function testSipAccount()
    {
        $expectedElement = '<sipaccount>sip@account</sipaccount>';

        $node = new SipAccount("sip@account");
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
