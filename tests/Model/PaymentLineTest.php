<?php

namespace Loevgaard\Dandomain\Pay\Model;

use PHPUnit\Framework\TestCase;

final class PaymentLineTest extends TestCase
{
    public function testGettersSetters()
    {
        $payment = new Payment();

        $paymentLine = new PaymentLine();
        $paymentLine
            ->setPayment($payment)
            ->setName('name')
            ->setQuantity(1)
            ->setPrice(79.96)
            ->setVat(25)
            ->setProductNumber('productnumber')
        ;

        $this->assertSame($payment, $paymentLine->getPayment());
        $this->assertSame('name', $paymentLine->getName());
        $this->assertSame(1, $paymentLine->getQuantity());
        $this->assertSame(79.96, $paymentLine->getPrice());
        $this->assertSame(79.96, $paymentLine->getPriceExclVat());
        $this->assertSame(99.95, $paymentLine->getPriceInclVat());
        $this->assertSame(25, $paymentLine->getVat());
        $this->assertSame('productnumber', $paymentLine->getProductNumber());
    }
}
