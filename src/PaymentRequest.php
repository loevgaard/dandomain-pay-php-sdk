<?php

namespace Loevgaard\Dandomain\Pay;

use Loevgaard\Dandomain\Pay\PaymentRequest\OrderLine;
use Symfony\Component\HttpFoundation\Request;

class PaymentRequest
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $merchant;

    /**
     * @var int
     */
    protected $orderId;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * @var string
     */
    protected $currencySymbol;

    /**
     * @var float
     */
    protected $totalAmount;

    /**
     * @var string
     */
    protected $callBackUrl;

    /**
     * @var string
     */
    protected $fullCallBackOkUrl;

    /**
     * @var string
     */
    protected $callBackOkUrl;

    /**
     * @var string
     */
    protected $callBackServerUrl;

    /**
     * @var int
     */
    protected $languageId;

    /**
     * @var boolean
     */
    protected $testMode;

    /**
     * @var int
     */
    protected $paymentGatewayCurrencyCode;

    /**
     * @var int
     */
    protected $cardTypeId;

    /**
     * @var string
     */
    protected $customerRekvNr;

    /**
     * @var string
     */
    protected $customerName;

    /**
     * @var string
     */
    protected $customerCompany;

    /**
     * @var string
     */
    protected $customerAddress;

    /**
     * @var string
     */
    protected $customerAddress2;

    /**
     * @var string
     */
    protected $customerZipCode;

    /**
     * @var string
     */
    protected $customerCity;

    /**
     * @var int
     */
    protected $customerCountryId;

    /**
     * @var string
     */
    protected $customerCountry;

    /**
     * @var string
     */
    protected $customerPhone;

    /**
     * @var string
     */
    protected $customerFax;

    /**
     * @var string
     */
    protected $customerEmail;

    /**
     * @var string
     */
    protected $customerNote;

    /**
     * @var string
     */
    protected $customerCvrnr;

    /**
     * @var int
     */
    protected $customerCustTypeId;

    /**
     * @var string
     */
    protected $customerEan;

    /**
     * @var string
     */
    protected $customerRes1;

    /**
     * @var string
     */
    protected $customerRes2;

    /**
     * @var string
     */
    protected $customerRes3;

    /**
     * @var string
     */
    protected $customerRes4;

    /**
     * @var string
     */
    protected $customerRes5;

    /**
     * @var string
     */
    protected $customerIp;

    /**
     * @var string
     */
    protected $deliveryName;

    /**
     * @var string
     */
    protected $deliveryCompany;

    /**
     * @var string
     */
    protected $deliveryAddress;

    /**
     * @var string
     */
    protected $deliveryAddress2;

    /**
     * @var string
     */
    protected $deliveryZipCode;

    /**
     * @var string
     */
    protected $deliveryCity;

    /**
     * @var int
     */
    protected $deliveryCountryID;

    /**
     * @var string
     */
    protected $deliveryCountry;

    /**
     * @var string
     */
    protected $deliveryPhone;

    /**
     * @var string
     */
    protected $deliveryFax;

    /**
     * @var string
     */
    protected $deliveryEmail;

    /**
     * @var string
     */
    protected $deliveryEan;

    /**
     * @var string
     */
    protected $shippingMethod;

    /**
     * @var float
     */
    protected $shippingFee;

    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var float
     */
    protected $paymentFee;

    /**
     * @var string
     */
    protected $loadBalancerRealIp;

    /**
     * @var OrderLine[]
     */
    protected $orderLines;

    public function __construct()
    {
        $this->orderLines = [];
    }

    public function populateFromRequest(Request $request)
    {
        $this->setApiKey($request->request->get('APIkey', ''));
        $this->setMerchant($request->request->get('APIMerchant', ''));
        $this->setOrderId($request->request->get('APIOrderID', 0));
        $this->setSessionId($request->request->get('APISessionID', ''));
        $this->setCurrencySymbol($request->request->get('APICurrencySymbol', ''));
        $this->setTotalAmount(static::currencyStringToFloat($request->request->get('APITotalAmount', '0.00')));
        $this->setCallBackUrl($request->request->get('APICallBackUrl', ''));
        $this->setFullCallBackOkUrl($request->request->get('APIFullCallBackOKUrl', ''));
        $this->setCallBackOkUrl($request->request->get('APICallBackOKUrl', ''));
        $this->setCallBackServerUrl($request->request->get('APICallBackServerUrl', ''));
        $this->setLanguageId((int)$request->request->get('APILanguageID', 0));
        $this->setTestMode($request->request->get('APITestMode') === 'True');
        $this->setPaymentGatewayCurrencyCode($request->request->get('APIPayGatewayCurrCode', 0));
        $this->setCardTypeId((int)$request->request->get('APICardTypeID', 0));
        $this->setCustomerRekvNr($request->request->get('APICRekvNr', ''));
        $this->setCustomerName($request->request->get('APICName', ''));
        $this->setCustomerCompany($request->request->get('APICCompany', ''));
        $this->setCustomerAddress($request->request->get('APICAddress', ''));
        $this->setCustomerAddress2($request->request->get('APICAddress2', ''));
        $this->setCustomerZipCode($request->request->get('APICZipCode', ''));
        $this->setCustomerCity($request->request->get('APICCity', ''));
        $this->setCustomerCountryId((int)$request->request->get('APICCountryID', 0));
        $this->setCustomerCountry($request->request->get('APICCountry', ''));
        $this->setCustomerPhone($request->request->get('APICPhone', ''));
        $this->setCustomerFax($request->request->get('APICFax', ''));
        $this->setCustomerEmail($request->request->get('APICEmail', ''));
        $this->setCustomerNote($request->request->get('APICNote', ''));
        $this->setCustomerCvrnr($request->request->get('APICcvrnr', ''));
        $this->setCustomerCustTypeId((int)$request->request->get('APICCustTypeID', 0));
        $this->setCustomerEan($request->request->get('APICEAN', ''));
        $this->setCustomerRes1($request->request->get('APICres1', ''));
        $this->setCustomerRes2($request->request->get('APICres2', ''));
        $this->setCustomerRes3($request->request->get('APICres3', ''));
        $this->setCustomerRes4($request->request->get('APICres4', ''));
        $this->setCustomerRes5($request->request->get('APICres5', ''));
        $this->setDeliveryName($request->request->get('APIDName', ''));
        $this->setDeliveryCompany($request->request->get('APIDCompany', ''));
        $this->setDeliveryAddress($request->request->get('APIDAddress', ''));
        $this->setDeliveryAddress2($request->request->get('APIDAddress2', ''));
        $this->setDeliveryZipCode($request->request->get('APIDZipCode', ''));
        $this->setDeliveryCity($request->request->get('APIDCity', ''));
        $this->setDeliveryCountryID((int)$request->request->get('APIDCountryID', 0));
        $this->setDeliveryCountry($request->request->get('APIDCountry', ''));
        $this->setDeliveryPhone($request->request->get('APIDPhone', ''));
        $this->setDeliveryFax($request->request->get('APIDFax', ''));
        $this->setDeliveryEmail($request->request->get('APIDEmail', ''));
        $this->setDeliveryEan($request->request->get('APIDean', ''));
        $this->setShippingMethod($request->request->get('APIShippingMethod', ''));
        $this->setShippingFee(static::currencyStringToFloat($request->request->get('APIShippingFee', '0.00')));
        $this->setPaymentMethod($request->request->get('APIPayMethod', ''));
        $this->setPaymentFee(static::currencyStringToFloat($request->request->get('APIPayFee', '0.00')));
        $this->setCustomerIp($request->request->get('APICIP', ''));
        $this->setLoadBalancerRealIp($request->request->get('APILoadBalancerRealIP', ''));

        // populate order lines
        $i = 1;
        while (true) {
            $exists = $request->request->get('APIBasketProdAmount'.$i, false);
            if ($exists === false) {
                break;
            }

            $orderLine = new OrderLine();
            $orderLine
                ->setQuantity((int)$request->request->get('APIBasketProdAmount'.$i, 0))
                ->setProductNumber($request->request->get('APIBasketProdNumber'.$i, ''))
                ->setName($request->request->get('APIBasketProdName'.$i, ''))
                ->setPrice(static::currencyStringToFloat($request->request->get('APIBasketProdPrice'.$i, '0.00')))
                ->setVat((int)$request->request->get('APIBasketProdVAT'.$i, 0))
            ;
            $this->addOrderLine($orderLine);

            $i++;
        }
    }

    /**
     * Takes strings like
     * - 1.000,50
     * - 1,000.50
     * - 1000.50
     * - 1000,50
     *
     * and returns 1000.50
     *
     * @param string $str
     * @return float
     */
    public static function currencyStringToFloat(string $str) : float
    {
        // verify format of string
        if (!preg_match('/(\.|,)[0-9]{2}$/', $str)) {
            throw new \InvalidArgumentException($str.' does not match the currency string format');
        }
        $str = preg_replace('/[^0-9]+/', '', $str);
        return intval($str) / 100;
    }

    /**
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return PaymentRequest
     */
    public function setApiKey(string $apiKey) : self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchant() : string
    {
        return $this->merchant;
    }

    /**
     * @param string $merchant
     * @return PaymentRequest
     */
    public function setMerchant(string $merchant) : self
    {
        $this->merchant = $merchant;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId() : int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     * @return PaymentRequest
     */
    public function setOrderId(int $orderId) : self
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId() : string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     * @return PaymentRequest
     */
    public function setSessionId(string $sessionId) : self
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencySymbol() : string
    {
        return $this->currencySymbol;
    }

    /**
     * @param string $currencySymbol
     * @return PaymentRequest
     */
    public function setCurrencySymbol(string $currencySymbol) : self
    {
        $this->currencySymbol = $currencySymbol;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalAmount() : float
    {
        return $this->totalAmount;
    }

    /**
     * @param float $totalAmount
     * @return PaymentRequest
     */
    public function setTotalAmount(float $totalAmount) : self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackUrl() : string
    {
        return $this->callBackUrl;
    }

    /**
     * @param string $callBackUrl
     * @return PaymentRequest
     */
    public function setCallBackUrl(string $callBackUrl) : self
    {
        $this->callBackUrl = $callBackUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getFullCallBackOkUrl() : string
    {
        return $this->fullCallBackOkUrl;
    }

    /**
     * @param string $fullCallBackOkUrl
     * @return PaymentRequest
     */
    public function setFullCallBackOkUrl(string $fullCallBackOkUrl) : self
    {
        $this->fullCallBackOkUrl = $fullCallBackOkUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackOkUrl() : string
    {
        return $this->callBackOkUrl;
    }

    /**
     * @param string $callBackOkUrl
     * @return PaymentRequest
     */
    public function setCallBackOkUrl(string $callBackOkUrl) : self
    {
        $this->callBackOkUrl = $callBackOkUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackServerUrl() : string
    {
        return $this->callBackServerUrl;
    }

    /**
     * @param string $callBackServerUrl
     * @return PaymentRequest
     */
    public function setCallBackServerUrl(string $callBackServerUrl) : self
    {
        $this->callBackServerUrl = $callBackServerUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getLanguageId() : int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     * @return PaymentRequest
     */
    public function setLanguageId(int $languageId) : self
    {
        $this->languageId = $languageId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTestMode(): bool
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     * @return PaymentRequest
     */
    public function setTestMode(bool $testMode) : self
    {
        $this->testMode = $testMode;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentGatewayCurrencyCode()
    {
        return $this->paymentGatewayCurrencyCode;
    }

    /**
     * @param int $paymentGatewayCurrencyCode
     * @return PaymentRequest
     */
    public function setPaymentGatewayCurrencyCode(int $paymentGatewayCurrencyCode) : self
    {
        $this->paymentGatewayCurrencyCode = $paymentGatewayCurrencyCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getCardTypeId()
    {
        return $this->cardTypeId;
    }

    /**
     * @param int $cardTypeId
     * @return PaymentRequest
     */
    public function setCardTypeId(int $cardTypeId) : self
    {
        $this->cardTypeId = $cardTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRekvNr() : string
    {
        return $this->customerRekvNr;
    }

    /**
     * @param string $customerRekvNr
     * @return PaymentRequest
     */
    public function setCustomerRekvNr(string $customerRekvNr) : self
    {
        $this->customerRekvNr = $customerRekvNr;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName() : string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     * @return PaymentRequest
     */
    public function setCustomerName(string $customerName) : self
    {
        $this->customerName = $customerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCompany() : string
    {
        return $this->customerCompany;
    }

    /**
     * @param string $customerCompany
     * @return PaymentRequest
     */
    public function setCustomerCompany(string $customerCompany) : self
    {
        $this->customerCompany = $customerCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerAddress() : string
    {
        return $this->customerAddress;
    }

    /**
     * @param string $customerAddress
     * @return PaymentRequest
     */
    public function setCustomerAddress(string $customerAddress) : self
    {
        $this->customerAddress = $customerAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerAddress2() : string
    {
        return $this->customerAddress2;
    }

    /**
     * @param string $customerAddress2
     * @return PaymentRequest
     */
    public function setCustomerAddress2(string $customerAddress2) : self
    {
        $this->customerAddress2 = $customerAddress2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerZipCode() : string
    {
        return $this->customerZipCode;
    }

    /**
     * @param string $customerZipCode
     * @return PaymentRequest
     */
    public function setCustomerZipCode(string $customerZipCode) : self
    {
        $this->customerZipCode = $customerZipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCity() : string
    {
        return $this->customerCity;
    }

    /**
     * @param string $customerCity
     * @return PaymentRequest
     */
    public function setCustomerCity(string $customerCity) : self
    {
        $this->customerCity = $customerCity;
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerCountryId()
    {
        return $this->customerCountryId;
    }

    /**
     * @param int $customerCountryId
     * @return PaymentRequest
     */
    public function setCustomerCountryId(int $customerCountryId) : self
    {
        $this->customerCountryId = $customerCountryId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCountry() : string
    {
        return $this->customerCountry;
    }

    /**
     * @param string $customerCountry
     * @return PaymentRequest
     */
    public function setCustomerCountry(string $customerCountry) : self
    {
        $this->customerCountry = $customerCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone() : string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     * @return PaymentRequest
     */
    public function setCustomerPhone(string $customerPhone) : self
    {
        $this->customerPhone = $customerPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerFax() : string
    {
        return $this->customerFax;
    }

    /**
     * @param string $customerFax
     * @return PaymentRequest
     */
    public function setCustomerFax(string $customerFax) : self
    {
        $this->customerFax = $customerFax;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail() : string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     * @return PaymentRequest
     */
    public function setCustomerEmail(string $customerEmail) : self
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerNote() : string
    {
        return $this->customerNote;
    }

    /**
     * @param string $customerNote
     * @return PaymentRequest
     */
    public function setCustomerNote(string $customerNote) : self
    {
        $this->customerNote = $customerNote;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCvrnr() : string
    {
        return $this->customerCvrnr;
    }

    /**
     * @param string $customerCvrnr
     * @return PaymentRequest
     */
    public function setCustomerCvrnr(string $customerCvrnr) : self
    {
        $this->customerCvrnr = $customerCvrnr;
        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerCustTypeId() : int
    {
        return $this->customerCustTypeId;
    }

    /**
     * @param int $customerCustTypeId
     * @return PaymentRequest
     */
    public function setCustomerCustTypeId(int $customerCustTypeId) : self
    {
        $this->customerCustTypeId = $customerCustTypeId;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEan() : string
    {
        return $this->customerEan;
    }

    /**
     * @param string $customerEan
     * @return PaymentRequest
     */
    public function setCustomerEan(string $customerEan) : self
    {
        $this->customerEan = $customerEan;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes1() : string
    {
        return $this->customerRes1;
    }

    /**
     * @param string $customerRes1
     * @return PaymentRequest
     */
    public function setCustomerRes1(string $customerRes1) : self
    {
        $this->customerRes1 = $customerRes1;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes2() : string
    {
        return $this->customerRes2;
    }

    /**
     * @param string $customerRes2
     * @return PaymentRequest
     */
    public function setCustomerRes2(string $customerRes2) : self
    {
        $this->customerRes2 = $customerRes2;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes3() : string
    {
        return $this->customerRes3;
    }

    /**
     * @param string $customerRes3
     * @return PaymentRequest
     */
    public function setCustomerRes3(string $customerRes3) : self
    {
        $this->customerRes3 = $customerRes3;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes4() : string
    {
        return $this->customerRes4;
    }

    /**
     * @param string $customerRes4
     * @return PaymentRequest
     */
    public function setCustomerRes4(string $customerRes4) : self
    {
        $this->customerRes4 = $customerRes4;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes5() : string
    {
        return $this->customerRes5;
    }

    /**
     * @param string $customerRes5
     * @return PaymentRequest
     */
    public function setCustomerRes5(string $customerRes5) : self
    {
        $this->customerRes5 = $customerRes5;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerIp() : string
    {
        return $this->customerIp;
    }

    /**
     * @param string $customerIp
     * @return PaymentRequest
     */
    public function setCustomerIp(string $customerIp) : self
    {
        $this->customerIp = $customerIp;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryName() : string
    {
        return $this->deliveryName;
    }

    /**
     * @param string $deliveryName
     * @return PaymentRequest
     */
    public function setDeliveryName(string $deliveryName) : self
    {
        $this->deliveryName = $deliveryName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCompany() : string
    {
        return $this->deliveryCompany;
    }

    /**
     * @param string $deliveryCompany
     * @return PaymentRequest
     */
    public function setDeliveryCompany(string $deliveryCompany) : self
    {
        $this->deliveryCompany = $deliveryCompany;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress() : string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     * @return PaymentRequest
     */
    public function setDeliveryAddress(string $deliveryAddress) : self
    {
        $this->deliveryAddress = $deliveryAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress2() : string
    {
        return $this->deliveryAddress2;
    }

    /**
     * @param string $deliveryAddress2
     * @return PaymentRequest
     */
    public function setDeliveryAddress2(string $deliveryAddress2) : self
    {
        $this->deliveryAddress2 = $deliveryAddress2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryZipCode() : string
    {
        return $this->deliveryZipCode;
    }

    /**
     * @param string $deliveryZipCode
     * @return PaymentRequest
     */
    public function setDeliveryZipCode(string $deliveryZipCode) : self
    {
        $this->deliveryZipCode = $deliveryZipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCity() : string
    {
        return $this->deliveryCity;
    }

    /**
     * @param string $deliveryCity
     * @return PaymentRequest
     */
    public function setDeliveryCity(string $deliveryCity) : self
    {
        $this->deliveryCity = $deliveryCity;
        return $this;
    }

    /**
     * @return int
     */
    public function getDeliveryCountryID()
    {
        return $this->deliveryCountryID;
    }

    /**
     * @param int $deliveryCountryID
     * @return PaymentRequest
     */
    public function setDeliveryCountryID(int $deliveryCountryID) : self
    {
        $this->deliveryCountryID = $deliveryCountryID;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCountry() : string
    {
        return $this->deliveryCountry;
    }

    /**
     * @param string $deliveryCountry
     * @return PaymentRequest
     */
    public function setDeliveryCountry(string $deliveryCountry) : self
    {
        $this->deliveryCountry = $deliveryCountry;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryPhone() : string
    {
        return $this->deliveryPhone;
    }

    /**
     * @param string $deliveryPhone
     * @return PaymentRequest
     */
    public function setDeliveryPhone(string $deliveryPhone) : self
    {
        $this->deliveryPhone = $deliveryPhone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryFax() : string
    {
        return $this->deliveryFax;
    }

    /**
     * @param string $deliveryFax
     * @return PaymentRequest
     */
    public function setDeliveryFax(string $deliveryFax) : self
    {
        $this->deliveryFax = $deliveryFax;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryEmail() : string
    {
        return $this->deliveryEmail;
    }

    /**
     * @param string $deliveryEmail
     * @return PaymentRequest
     */
    public function setDeliveryEmail(string $deliveryEmail) : self
    {
        $this->deliveryEmail = $deliveryEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryEan() : string
    {
        return $this->deliveryEan;
    }

    /**
     * @param string $deliveryEan
     * @return PaymentRequest
     */
    public function setDeliveryEan(string $deliveryEan) : self
    {
        $this->deliveryEan = $deliveryEan;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingMethod() : string
    {
        return $this->shippingMethod;
    }

    /**
     * @param string $shippingMethod
     * @return PaymentRequest
     */
    public function setShippingMethod(string $shippingMethod) : self
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return float
     */
    public function getShippingFee() : float
    {
        return $this->shippingFee;
    }

    /**
     * @param float $shippingFee
     * @return PaymentRequest
     */
    public function setShippingFee(float $shippingFee) : self
    {
        $this->shippingFee = $shippingFee;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod() : string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return PaymentRequest
     */
    public function setPaymentMethod(string $paymentMethod) : self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * @return float
     */
    public function getPaymentFee() : float
    {
        return $this->paymentFee;
    }

    /**
     * @param float $paymentFee
     * @return PaymentRequest
     */
    public function setPaymentFee(float $paymentFee) : self
    {
        $this->paymentFee = $paymentFee;
        return $this;
    }

    /**
     * @return string
     */
    public function getLoadBalancerRealIp() : string
    {
        return $this->loadBalancerRealIp;
    }

    /**
     * @param string $loadBalancerRealIp
     * @return PaymentRequest
     */
    public function setLoadBalancerRealIp(string $loadBalancerRealIp) : self
    {
        $this->loadBalancerRealIp = $loadBalancerRealIp;
        return $this;
    }

    /**
     * @return OrderLine[]
     */
    public function getOrderLines() : array
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLine[] $orderLines
     * @return PaymentRequest
     */
    public function setOrderLines(array $orderLines) : self
    {
        $this->orderLines = $orderLines;
        return $this;
    }

    /**
     * @param OrderLine $orderLine
     * @return PaymentRequest
     */
    public function addOrderLine(OrderLine $orderLine) : self
    {
        $this->orderLines[] = $orderLine;
        return $this;
    }
}
