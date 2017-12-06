<?php

namespace Loevgaard\Dandomain\Pay\Model;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;

final class PaymentLineTest extends TestCase
{
    public function testGettersSetters()
    {
        $payment = new Payment();

        $vat = new Money('1999', new Currency('DKK'));
        $price = new Money('7996', new Currency('DKK'));
        $priceInclVat = new Money('9995', new Currency('DKK'));

        $paymentLine = new PaymentLine('productnumber', 'name', 1, $price, 25);
        $paymentLine
            ->setPayment($payment)
        ;

        $this->assertSame($payment, $paymentLine->getPayment());
        $this->assertSame('name', $paymentLine->getName());
        $this->assertSame(1, $paymentLine->getQuantity());
        $this->assertEquals($price, $paymentLine->getPrice());
        $this->assertEquals($price, $paymentLine->getPriceExclVat());
        $this->assertEquals($vat, $paymentLine->getVatAmount());
        $this->assertEquals($priceInclVat, $paymentLine->getPriceInclVat());
        $this->assertSame(25, $paymentLine->getVat());
        $this->assertSame('productnumber', $paymentLine->getProductNumber());
    }
}
