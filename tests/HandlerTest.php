<?php

namespace Loevgaard\Dandomain\Pay;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

final class HandlerTest extends TestCase
{
    public function testChecksumMatches()
    {
        $serverRequest = $this->createMock(ServerRequestInterface::class);
        $handler = new Handler($serverRequest, 'key1', 'key2');
        $paymentRequest = new PaymentRequest();
        $paymentRequest
            ->setApiKey('c30c731cc1e22e9d0f7ce4fa9768a4df')
            ->setOrderId(1)
            ->setTotalAmount(100.50)
            ->setPaymentGatewayCurrencyCode(208)
        ;

        $handler->setPaymentRequest($paymentRequest);

        $this->assertTrue($handler->checksumMatches());
    }
    public function testGenerateChecksum1()
    {
        $orderId = 100;
        $amount = 250.75;
        $sharedKey = 'key';
        $currency = 208;

        $result = Handler::generateChecksum1($orderId, $amount, $sharedKey, $currency);
        $expected = '56f036063e176120b5fb96adc9d9e899';

        $this->assertEquals($expected, $result);
    }

    public function testGenerateChecksum2()
    {
        $orderId = 100;
        $sharedKey = 'key';
        $currency = 208;

        $result = Handler::generateChecksum2($orderId, $sharedKey, $currency);
        $expected = '256c77ebbe2664f7ef7e683c3c152033';

        $this->assertEquals($expected, $result);

        $serverRequest = $this->createMock(ServerRequestInterface::class);
        $handler = new Handler($serverRequest, 'key', 'key');
        $paymentRequest = new PaymentRequest();
        $paymentRequest
            ->setOrderId(100)
            ->setPaymentGatewayCurrencyCode(208)
        ;
        $handler->setPaymentRequest($paymentRequest);
        $this->assertEquals($expected, $handler->getChecksum2());
    }

    public function testGetSetPaymentRequest()
    {
        $serverRequest = $this->createMock(ServerRequestInterface::class);
        $handler = new Handler($serverRequest, 'key1', 'key2');
        $paymentRequest = new PaymentRequest();
        $paymentRequest->setApiKey('c30c731cc1e22e9d0f7ce4fa9768a4df');
        $handler->setPaymentRequest($paymentRequest);

        $this->assertEquals($paymentRequest, $handler->getPaymentRequest());
    }
}
