<?php

namespace Loevgaard\Dandomain\Pay\Model;

use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequestFactory;

final class PaymentTest extends TestCase
{
    public function testCreateFromRequest()
    {
        $serverRequest = [
            'HTTP_REFERER' => 'referrer',
        ];

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
            'APIShippingMethodID' => '48',
            'APIShippingFee' => '200,00',
            'APIPayMethod' => 'Kreditkort',
            'APIPayMethodID' => '60',
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
            'APIBasketProdVAT2' => '25',
        ];
        $request = ServerRequestFactory::fromGlobals($serverRequest, null, $postRequest);

        $payment = Payment::createFromRequest($request);

        $this->assertSame($postRequest['APIkey'], $payment->getApiKey());
        $this->assertSame($postRequest['APIMerchant'], $payment->getMerchant());
        $this->assertSame((int)$postRequest['APIOrderID'], $payment->getOrderId());
        $this->assertSame($postRequest['APISessionID'], $payment->getSessionId());
        $this->assertSame($postRequest['APICurrencySymbol'], $payment->getCurrencySymbol());
        $this->assertSame(349.75, $payment->getTotalAmount());
        $this->assertSame($postRequest['APICallBackUrl'], $payment->getCallBackUrl());
        $this->assertSame($postRequest['APIFullCallBackOKUrl'], $payment->getFullCallBackOkUrl());
        $this->assertSame($postRequest['APICallBackOKUrl'], $payment->getCallBackOkUrl());
        $this->assertSame($postRequest['APICallBackServerUrl'], $payment->getCallBackServerUrl());
        $this->assertSame((int) $postRequest['APILanguageID'], $payment->getLanguageId());
        $this->assertSame(false, $payment->isTestMode());
        $this->assertSame((int) $postRequest['APIPayGatewayCurrCode'], $payment->getPaymentGatewayCurrencyCode());
        $this->assertSame((int) $postRequest['APICardTypeID'], $payment->getCardTypeId());
        $this->assertSame($postRequest['APICRekvNr'], $payment->getCustomerRekvNr());
        $this->assertSame($postRequest['APICName'], $payment->getCustomerName());
        $this->assertSame($postRequest['APICCompany'], $payment->getCustomerCompany());
        $this->assertSame($postRequest['APICAddress'], $payment->getCustomerAddress());
        $this->assertSame($postRequest['APICAddress2'], $payment->getCustomerAddress2());
        $this->assertSame($postRequest['APICZipCode'], $payment->getCustomerZipCode());
        $this->assertSame($postRequest['APICCity'], $payment->getCustomerCity());
        $this->assertSame((int)$postRequest['APICCountryID'], $payment->getCustomerCountryId());
        $this->assertSame($postRequest['APICCountry'], $payment->getCustomerCountry());
        $this->assertSame($postRequest['APICPhone'], $payment->getCustomerPhone());
        $this->assertSame($postRequest['APICFax'], $payment->getCustomerFax());
        $this->assertSame($postRequest['APICEmail'], $payment->getCustomerEmail());
        $this->assertSame($postRequest['APICNote'], $payment->getCustomerNote());
        $this->assertSame($postRequest['APICcvrnr'], $payment->getCustomerCvrnr());
        $this->assertSame((int) $postRequest['APICCustTypeID'], $payment->getCustomerCustTypeId());
        $this->assertSame($postRequest['APICEAN'], $payment->getCustomerEan());
        $this->assertSame($postRequest['APICres1'], $payment->getCustomerRes1());
        $this->assertSame($postRequest['APICres2'], $payment->getCustomerRes2());
        $this->assertSame($postRequest['APICres3'], $payment->getCustomerRes3());
        $this->assertSame($postRequest['APICres4'], $payment->getCustomerRes4());
        $this->assertSame($postRequest['APICres5'], $payment->getCustomerRes5());
        $this->assertSame($postRequest['APIDName'], $payment->getDeliveryName());
        $this->assertSame($postRequest['APIDCompany'], $payment->getDeliveryCompany());
        $this->assertSame($postRequest['APIDAddress'], $payment->getDeliveryAddress());
        $this->assertSame($postRequest['APIDAddress2'], $payment->getDeliveryAddress2());
        $this->assertSame($postRequest['APIDZipCode'], $payment->getDeliveryZipCode());
        $this->assertSame($postRequest['APIDCity'], $payment->getDeliveryCity());
        $this->assertSame((int) $postRequest['APIDCountryID'], $payment->getDeliveryCountryID());
        $this->assertSame($postRequest['APIDCountry'], $payment->getDeliveryCountry());
        $this->assertSame($postRequest['APIDPhone'], $payment->getDeliveryPhone());
        $this->assertSame($postRequest['APIDFax'], $payment->getDeliveryFax());
        $this->assertSame($postRequest['APIDEmail'], $payment->getDeliveryEmail());
        $this->assertSame($postRequest['APIDean'], $payment->getDeliveryEan());
        $this->assertSame($postRequest['APIShippingMethod'], $payment->getShippingMethod());
        $this->assertSame((int)$postRequest['APIShippingMethodID'], $payment->getShippingMethodId());
        $this->assertSame(200.00, $payment->getShippingFee());
        $this->assertSame($postRequest['APIPayMethod'], $payment->getPaymentMethod());
        $this->assertSame((int)$postRequest['APIPayMethodID'], $payment->getPaymentMethodId());
        $this->assertSame(100.00, $payment->getPaymentFee());
        $this->assertSame($postRequest['APICIP'], $payment->getCustomerIp());
        $this->assertSame($postRequest['APILoadBalancerRealIP'], $payment->getLoadBalancerRealIp());
        $this->assertSame($serverRequest['HTTP_REFERER'], $payment->getReferrer());

        $i = 1;
        foreach ($payment->getPaymentLines() as $paymentLine) {
            $qty = (int)$postRequest['APIBasketProdAmount'.$i];
            $productNumber = $postRequest['APIBasketProdNumber'.$i];
            $name = $postRequest['APIBasketProdName'.$i];
            $price = Payment::currencyStringToFloat($postRequest['APIBasketProdPrice'.$i]);
            $vat = (int) $postRequest['APIBasketProdVAT'.$i];

            $this->assertSame($qty, $paymentLine->getQuantity());
            $this->assertSame($productNumber, $paymentLine->getProductNumber());
            $this->assertSame($name, $paymentLine->getName());
            $this->assertSame($price, $paymentLine->getPrice());
            $this->assertSame($vat, $paymentLine->getVat());

            ++$i;
        }
    }

    public function testSetPaymentLines()
    {
        $paymentLine = new PaymentLine();
        $paymentLine
            ->setVat(25)
            ->setPrice(100.50)
            ->setName('name')
            ->setProductNumber('product_number')
            ->setQuantity(1)
        ;

        $paymentLines = [$paymentLine];

        $paymentRequest = new Payment();
        $paymentRequest->setPaymentLines($paymentLines);

        $this->assertSame($paymentLines, $paymentRequest->getPaymentLines());
    }

    public function testCurrencyStringToFloat()
    {
        $this->assertSame(1000.50, Payment::currencyStringToFloat('1,000.50'));
        $this->assertSame(1000.50, Payment::currencyStringToFloat('1000.50'));
        $this->assertSame(1000.50, Payment::currencyStringToFloat('1.000,50'));
        $this->assertSame(1000.50, Payment::currencyStringToFloat('1000,50'));

        $this->expectException('\InvalidArgumentException');
        Payment::currencyStringToFloat('1000,5');
    }
}
