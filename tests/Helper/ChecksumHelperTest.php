<?php

namespace Loevgaard\Dandomain\Pay\Helper;

use Loevgaard\Dandomain\Pay\Model\Payment;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class ChecksumHelperTest extends TestCase
{
    public function testChecksumMatches()
    {
        $payment = new Payment();
        $payment
            ->setApiKey('c30c731cc1e22e9d0f7ce4fa9768a4df')
            ->setOrderId(1)
            ->setTotalAmount(new Money('10050', new Currency('DKK')))
            ->setPaymentGatewayCurrencyCode(208)
        ;
        $handler = new ChecksumHelper($payment, 'key1', 'key2');

        $this->assertTrue($handler->checksumMatches());
    }

    public function testGenerateChecksum1()
    {
        $orderId = 100;
        $amount = new Money('25075', new Currency('DKK'));
        $sharedKey = 'key';
        $currency = 208;

        $result = ChecksumHelper::generateChecksum1($orderId, $amount, $sharedKey, $currency);
        $expected = '56f036063e176120b5fb96adc9d9e899';

        $this->assertEquals($expected, $result);
    }

    public function testGenerateChecksum2()
    {
        $orderId = 100;
        $sharedKey = 'key';
        $currency = 208;

        $result = ChecksumHelper::generateChecksum2($orderId, $sharedKey, $currency);
        $expected = '256c77ebbe2664f7ef7e683c3c152033';

        $this->assertEquals($expected, $result);

        $payment = new Payment();
        $payment
            ->setOrderId(100)
            ->setPaymentGatewayCurrencyCode(208)
        ;
        $handler = new ChecksumHelper($payment, 'key', 'key');

        $this->assertEquals($expected, $handler->getChecksum2());
    }
}
