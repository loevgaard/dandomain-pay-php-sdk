<?php

namespace Loevgaard\Dandomain\Pay;

use Loevgaard\Dandomain\Pay\PaymentRequest\OrderLine;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

final class PaymentRequestTest extends TestCase
{
    public function testPopulateFromRequest()
    {
        $postRequest = [
            'APIkey' => 'a2957ab9ac712b73f75264dbb8858fd2',
            'APIMerchant' => '123456',
            'APIOrderID' => '230183',
            'APISessionID' => 'ASPSESSIONIDSQQABRSB=JCJJHLCBCCGHEPAMNGOBNCIH',
            'APICurrencySymbol' => 'DKK',
            'APITotalAmount' => '349,75',
            'APICallBackUrl' => 'example.com',
            'APIFullCallBackOKUrl' => 'http://example.com/shop/order4.html?SkinPreview=141',
            'APICallBackOKUrl' => 'example.com/shop/order4.asp',
            'APICallBackServerUrl' => 'example.com/shop/order4.asp?dontclearbasket=1',
            'APILanguageID' => '37',
            'APITestMode' => 'False',
            'APIPayGatewayCurrCode' => '208',
            'APICardTypeID' => '0',
            'APICRekvNr' => 'rekv-101010',
            'APICName' => 'Brian Mikkelsen',
            'APICCompany' => 'Firmaet ApS',
            'APICAddress' => 'Vejen 9',
            'APICAddress2' => 'Under Lunden',
            'APICZipCode' => '9000',
            'APICCity' => 'Aalborg',
            'APICCountryID' => '4911',
            'APICCountry' => 'Danmark',
            'APICPhone' => '11202020',
            'APICFax' => '22222222',
            'APICEmail' => 'brian@mikkelsen.dk',
            'APICNote' => 'Note',
            'APICcvrnr' => '30303030',
            'APICCustTypeID' => '2',
            'APICEAN' => '5194734211571',
            'APICres1' => '0',
            'APICres2' => '1',
            'APICres3' => 'variant',
            'APICres4' => '100,50',
            'APICres5' => 'extra@mikkelsen.dk',
            'APIDName' => 'Julie Mikkelsen',
            'APIDCompany' => 'Julie ApS',
            'APIDAddress' => 'Over Broen 10',
            'APIDAddress2' => 'Dør 1',
            'APIDZipCode' => '8000',
            'APIDCity' => 'Aarhus C',
            'APIDCountryID' => '3810',
            'APIDCountry' => 'England',
            'APIDPhone' => '+445697454778',
            'APIDFax' => '',
            'APIDEmail' => 'julie@mikkelsen.dk',
            'APIDean' => '',
            'APIShippingMethod' => 'Afhentning',
            'APIShippingFee' => '200,00',
            'APIPayMethod' => 'Kreditkort',
            'APIPayFee' => '100,00',
            'APICIP' => '77.68.224.227',
            'APILoadBalancerRealIP' => '12.58.66.6',
            'APIBasketProdNumber1' => '5971347-M',
            'APIBasketProdName1' => 'Jeans Medium',
            'APIBasketProdAmount1' => '1',
            'APIBasketProdPrice1' => '319,80',
            'APIBasketProdVAT1' => '25',
            'APIBasketProdNumber2' => '7891134-L',
            'APIBasketProdName2' => 'T-Shirt Large',
            'APIBasketProdAmount2' => '1',
            'APIBasketProdPrice2' => '119,80',
            'APIBasketProdVAT2' => '25'
        ];
        $request = new Request([], $postRequest);

        $handler = new Handler($request, 'key1', 'key2');

        $paymentRequest = $handler->getPaymentRequest();

        $this->assertEquals($postRequest['APIkey'], $paymentRequest->getApiKey());

        $this->assertInternalType('string', $paymentRequest->getMerchant());
        $this->assertEquals($postRequest['APIMerchant'], $paymentRequest->getMerchant());

        $this->assertInternalType('int', $paymentRequest->getOrderId());
        $this->assertEquals($postRequest['APIOrderID'], $paymentRequest->getOrderId());

        $this->assertInternalType('string', $paymentRequest->getMerchant());
        $this->assertEquals($postRequest['APISessionID'], $paymentRequest->getSessionId());

        $this->assertInternalType('string', $paymentRequest->getCurrencySymbol());
        $this->assertEquals($postRequest['APICurrencySymbol'], $paymentRequest->getCurrencySymbol());

        $this->assertInternalType('float', $paymentRequest->getTotalAmount());
        $this->assertEquals(349.75, $paymentRequest->getTotalAmount());

        $this->assertInternalType('string', $paymentRequest->getCallBackUrl());
        $this->assertEquals($postRequest['APICallBackUrl'], $paymentRequest->getCallBackUrl());

        $this->assertInternalType('string', $paymentRequest->getFullCallBackOkUrl());
        $this->assertEquals($postRequest['APIFullCallBackOKUrl'], $paymentRequest->getFullCallBackOkUrl());

        $this->assertInternalType('string', $paymentRequest->getCallBackOkUrl());
        $this->assertEquals($postRequest['APICallBackOKUrl'], $paymentRequest->getCallBackOkUrl());

        $this->assertInternalType('string', $paymentRequest->getCallBackServerUrl());
        $this->assertEquals($postRequest['APICallBackServerUrl'], $paymentRequest->getCallBackServerUrl());

        $this->assertInternalType('int', $paymentRequest->getLanguageId());
        $this->assertEquals((int)$postRequest['APILanguageID'], $paymentRequest->getLanguageId());

        $this->assertInternalType('bool', $paymentRequest->isTestMode());
        $this->assertEquals(false, $paymentRequest->isTestMode());

        $this->assertInternalType('int', $paymentRequest->getPaymentGatewayCurrencyCode());
        $this->assertEquals(
            (int)$postRequest['APIPayGatewayCurrCode'],
            $paymentRequest->getPaymentGatewayCurrencyCode()
        );

        $this->assertInternalType('int', $paymentRequest->getCardTypeId());
        $this->assertEquals((int)$postRequest['APICardTypeID'], $paymentRequest->getCardTypeId());

        $this->assertInternalType('string', $paymentRequest->getCustomerRekvNr());
        $this->assertEquals($postRequest['APICRekvNr'], $paymentRequest->getCustomerRekvNr());

        $this->assertInternalType('string', $paymentRequest->getCustomerName());
        $this->assertEquals($postRequest['APICName'], $paymentRequest->getCustomerName());

        $this->assertInternalType('string', $paymentRequest->getCustomerCompany());
        $this->assertEquals($postRequest['APICCompany'], $paymentRequest->getCustomerCompany());

        $this->assertInternalType('string', $paymentRequest->getCustomerAddress());
        $this->assertEquals($postRequest['APICAddress'], $paymentRequest->getCustomerAddress());

        $this->assertInternalType('string', $paymentRequest->getCustomerAddress2());
        $this->assertEquals($postRequest['APICAddress2'], $paymentRequest->getCustomerAddress2());

        $this->assertInternalType('string', $paymentRequest->getCustomerZipCode());
        $this->assertEquals($postRequest['APICZipCode'], $paymentRequest->getCustomerZipCode());

        $this->assertInternalType('string', $paymentRequest->getCustomerCity());
        $this->assertEquals($postRequest['APICCity'], $paymentRequest->getCustomerCity());

        $this->assertInternalType('int', $paymentRequest->getCustomerCountryId());
        $this->assertEquals($postRequest['APICCountryID'], $paymentRequest->getCustomerCountryId());

        $this->assertInternalType('string', $paymentRequest->getCustomerCountry());
        $this->assertEquals($postRequest['APICCountry'], $paymentRequest->getCustomerCountry());

        $this->assertInternalType('string', $paymentRequest->getCustomerPhone());
        $this->assertEquals($postRequest['APICPhone'], $paymentRequest->getCustomerPhone());

        $this->assertInternalType('string', $paymentRequest->getCustomerFax());
        $this->assertEquals($postRequest['APICFax'], $paymentRequest->getCustomerFax());

        $this->assertInternalType('string', $paymentRequest->getCustomerEmail());
        $this->assertEquals($postRequest['APICEmail'], $paymentRequest->getCustomerEmail());

        $this->assertInternalType('string', $paymentRequest->getCustomerNote());
        $this->assertEquals($postRequest['APICNote'], $paymentRequest->getCustomerNote());

        $this->assertInternalType('string', $paymentRequest->getCustomerCvrnr());
        $this->assertEquals($postRequest['APICcvrnr'], $paymentRequest->getCustomerCvrnr());

        $this->assertInternalType('int', $paymentRequest->getCustomerCustTypeId());
        $this->assertEquals((int)$postRequest['APICCustTypeID'], $paymentRequest->getCustomerCustTypeId());

        $this->assertInternalType('string', $paymentRequest->getCustomerEan());
        $this->assertEquals($postRequest['APICEAN'], $paymentRequest->getCustomerEan());

        $this->assertInternalType('string', $paymentRequest->getCustomerRes1());
        $this->assertEquals($postRequest['APICres1'], $paymentRequest->getCustomerRes1());

        $this->assertInternalType('string', $paymentRequest->getCustomerRes2());
        $this->assertEquals($postRequest['APICres2'], $paymentRequest->getCustomerRes2());

        $this->assertInternalType('string', $paymentRequest->getCustomerRes3());
        $this->assertEquals($postRequest['APICres3'], $paymentRequest->getCustomerRes3());

        $this->assertInternalType('string', $paymentRequest->getCustomerRes4());
        $this->assertEquals($postRequest['APICres4'], $paymentRequest->getCustomerRes4());

        $this->assertInternalType('string', $paymentRequest->getCustomerRes5());
        $this->assertEquals($postRequest['APICres5'], $paymentRequest->getCustomerRes5());

        $this->assertInternalType('string', $paymentRequest->getDeliveryName());
        $this->assertEquals($postRequest['APIDName'], $paymentRequest->getDeliveryName());

        $this->assertInternalType('string', $paymentRequest->getDeliveryCompany());
        $this->assertEquals($postRequest['APIDCompany'], $paymentRequest->getDeliveryCompany());

        $this->assertInternalType('string', $paymentRequest->getDeliveryAddress());
        $this->assertEquals($postRequest['APIDAddress'], $paymentRequest->getDeliveryAddress());

        $this->assertInternalType('string', $paymentRequest->getDeliveryAddress2());
        $this->assertEquals($postRequest['APIDAddress2'], $paymentRequest->getDeliveryAddress2());

        $this->assertInternalType('string', $paymentRequest->getDeliveryZipCode());
        $this->assertEquals($postRequest['APIDZipCode'], $paymentRequest->getDeliveryZipCode());

        $this->assertInternalType('string', $paymentRequest->getDeliveryCity());
        $this->assertEquals($postRequest['APIDCity'], $paymentRequest->getDeliveryCity());

        $this->assertInternalType('int', $paymentRequest->getDeliveryCountryID());
        $this->assertEquals((int)$postRequest['APIDCountryID'], $paymentRequest->getDeliveryCountryID());

        $this->assertInternalType('string', $paymentRequest->getDeliveryCountry());
        $this->assertEquals($postRequest['APIDCountry'], $paymentRequest->getDeliveryCountry());

        $this->assertInternalType('string', $paymentRequest->getDeliveryPhone());
        $this->assertEquals($postRequest['APIDPhone'], $paymentRequest->getDeliveryPhone());

        $this->assertInternalType('string', $paymentRequest->getDeliveryFax());
        $this->assertEquals($postRequest['APIDFax'], $paymentRequest->getDeliveryFax());

        $this->assertInternalType('string', $paymentRequest->getDeliveryEmail());
        $this->assertEquals($postRequest['APIDEmail'], $paymentRequest->getDeliveryEmail());

        $this->assertInternalType('string', $paymentRequest->getDeliveryEan());
        $this->assertEquals($postRequest['APIDean'], $paymentRequest->getDeliveryEan());

        $this->assertInternalType('string', $paymentRequest->getShippingMethod());
        $this->assertEquals($postRequest['APIShippingMethod'], $paymentRequest->getShippingMethod());

        $this->assertInternalType('float', $paymentRequest->getShippingFee());
        $this->assertEquals(200.00, $paymentRequest->getShippingFee());

        $this->assertInternalType('string', $paymentRequest->getPaymentMethod());
        $this->assertEquals($postRequest['APIPayMethod'], $paymentRequest->getPaymentMethod());

        $this->assertInternalType('float', $paymentRequest->getPaymentFee());
        $this->assertEquals(100.00, $paymentRequest->getPaymentFee());

        $this->assertInternalType('string', $paymentRequest->getCustomerIp());
        $this->assertEquals($postRequest['APICIP'], $paymentRequest->getCustomerIp());

        $this->assertInternalType('string', $paymentRequest->getLoadBalancerRealIp());
        $this->assertEquals($postRequest['APILoadBalancerRealIP'], $paymentRequest->getLoadBalancerRealIp());

        $i = 1;
        foreach ($paymentRequest->getOrderLines() as $orderLine) {
            $this->assertInternalType('int', $orderLine->getQuantity());
            $this->assertInternalType('string', $orderLine->getProductNumber());
            $this->assertInternalType('string', $orderLine->getName());
            $this->assertInternalType('float', $orderLine->getPrice());
            $this->assertInternalType('int', $orderLine->getVat());

            $qty = $postRequest['APIBasketProdAmount'.$i];
            $productNumber = $postRequest['APIBasketProdNumber'.$i];
            $name = $postRequest['APIBasketProdName'.$i];
            $price = PaymentRequest::currencyStringToFloat($postRequest['APIBasketProdPrice'.$i]);
            $vat = (int)$postRequest['APIBasketProdVAT'.$i];

            $this->assertEquals($qty, $orderLine->getQuantity());
            $this->assertEquals($productNumber, $orderLine->getProductNumber());
            $this->assertEquals($name, $orderLine->getName());
            $this->assertEquals($price, $orderLine->getPrice());
            $this->assertEquals($vat, $orderLine->getVat());

            $i++;
        }
    }

    public function testSetOrderLines()
    {
        $orderLine = new OrderLine();
        $orderLine
            ->setVat(25)
            ->setPrice(100.50)
            ->setName('name')
            ->setProductNumber('product_number')
            ->setQuantity(1)
        ;

        $orderLines = [$orderLine];

        $paymentRequest = new PaymentRequest();
        $paymentRequest->setOrderLines($orderLines);

        $this->assertEquals($orderLines, $paymentRequest->getOrderLines());
    }

    public function testCurrencyStringToFloat()
    {
        $this->assertEquals(1000.50, PaymentRequest::currencyStringToFloat('1,000.50'));
        $this->assertEquals(1000.50, PaymentRequest::currencyStringToFloat('1000.50'));
        $this->assertEquals(1000.50, PaymentRequest::currencyStringToFloat('1.000,50'));
        $this->assertEquals(1000.50, PaymentRequest::currencyStringToFloat('1000,50'));

        $this->expectException('\InvalidArgumentException');
        PaymentRequest::currencyStringToFloat('1000,5');
    }
}
