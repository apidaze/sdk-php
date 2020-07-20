<?php

use Apidaze\Builder\Nodes\BaseNode;
use Apidaze\Builder\Nodes\Dial;
use Apidaze\Builder\Nodes\DialStrategy;
use Apidaze\Builder\Nodes\DialTargetType;
use Apidaze\Builder\Nodes\Number;
use Apidaze\Builder\Nodes\SipAccount;
use Apidaze\Builder\Nodes\SipUri;

use PHPUnit\Framework\TestCase;

class DialTest extends TestCase
{
    public function testDialNumber()
    {
        $expectedElement = <<<'EOL'
<dial timeout="60" strategy="simultaneous">
  <number>1234567890</number>
</dial>
EOL;

        $node = new Dial("1234567890", DialTargetType::number);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testDialSipAccount()
    {
        $expectedElement = <<<'EOL'
<dial timeout="60" strategy="simultaneous">
  <sipaccount>sip@account</sipaccount>
</dial>
EOL;

        $node = new Dial("sip@account", DialTargetType::sipacount);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testDialSipUri()
    {
        $expectedElement = <<<'EOL'
<dial timeout="60" strategy="simultaneous">
  <sipuri>sip://uri</sipuri>
</dial>
EOL;

        $node = new Dial("sip://uri", DialTargetType::sipuri);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testDialNumberSequence()
    {
        $expectedElement = <<<'EOL'
<dial timeout="60" strategy="sequence">
  <number>1234567890</number>
</dial>
EOL;

        $node = new Dial("1234567890", DialTargetType::number, 60, null, DialStrategy::sequence);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testDialNumberTimeout()
    {
        $expectedElement = <<<'EOL'
<dial timeout="120" strategy="simultaneous">
  <number>1234567890</number>
</dial>
EOL;

        $node = new Dial("1234567890", DialTargetType::number, 120);
        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }

    public function testDialDifferentTargets()
    {
        $expectedElement = <<<'EOL'
<dial timeout="60" strategy="simultaneous">
  <number>1234567890</number>
  <sipaccount>sip@account</sipaccount>
  <sipuri>sip://uri</sipuri>
</dial>
EOL;

        $node = new Dial("1234567890", DialTargetType::number);

        $sipaccount = new SipAccount("sip@account");
        $sipuri = new SipUri("sip://uri");
        $node->add($sipaccount)
            ->add($sipuri);

        $got = $node->xmlToTest();

        $this->assertEquals($got, $expectedElement);
    }
}
