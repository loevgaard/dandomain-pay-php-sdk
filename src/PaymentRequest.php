<?php
namespace Loevgaard\Dandomain\Pay;

use Loevgaard\Dandomain\Pay\PaymentRequest\PaymentLine;
use Psr\Http\Message\ServerRequestInterface;

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
     * @var string
     */
    protected $referrer;

    /**
     * @var PaymentLine[]
     */
    protected $paymentLines;

    public function __construct()
    {
        $this->paymentLines = [];
    }

    public function populateFromRequest(ServerRequestInterface $request)
    {
        $body = $request->getParsedBody();
        $body = is_array($body) ? $body : [];

        $this->setApiKey($body['APIkey'] ?? '');
        $this->setMerchant($body['APIMerchant'] ?? '');
        $this->setOrderId($body['APIOrderID'] ?? 0);
        $this->setSessionId($body['APISessionID'] ?? '');
        $this->setCurrencySymbol($body['APICurrencySymbol'] ?? '');
        $this->setTotalAmount(static::currencyStringToFloat($body['APITotalAmount'] ?? '0.00', 'APITotalAmount'));
        $this->setCallBackUrl($body['APICallBackUrl'] ?? '');
        $this->setFullCallBackOkUrl($body['APIFullCallBackOKUrl'] ?? '');
        $this->setCallBackOkUrl($body['APICallBackOKUrl'] ?? '');
        $this->setCallBackServerUrl($body['APICallBackServerUrl'] ?? '');
        $this->setLanguageId(isset($body['APILanguageID']) ? (int)$body['APILanguageID'] :  0);
        $this->setTestMode(isset($body['APITestMode']) && $body['APITestMode'] === 'True');
        $this->setPaymentGatewayCurrencyCode(
            isset($body['APIPayGatewayCurrCode']) ? (int)$body['APIPayGatewayCurrCode'] : 0
        );
        $this->setCardTypeId(isset($body['APICardTypeID']) ? (int)$body['APICardTypeID'] : 0);
        $this->setCustomerRekvNr($body['APICRekvNr'] ?? '');
        $this->setCustomerName($body['APICName'] ?? '');
        $this->setCustomerCompany($body['APICCompany'] ?? '');
        $this->setCustomerAddress($body['APICAddress'] ?? '');
        $this->setCustomerAddress2($body['APICAddress2'] ?? '');
        $this->setCustomerZipCode($body['APICZipCode'] ?? '');
        $this->setCustomerCity($body['APICCity'] ?? '');
        $this->setCustomerCountryId(isset($body['APICCountryID']) ? (int)$body['APICCountryID'] : 0);
        $this->setCustomerCountry($body['APICCountry'] ?? '');
        $this->setCustomerPhone($body['APICPhone'] ?? '');
        $this->setCustomerFax($body['APICFax'] ?? '');
        $this->setCustomerEmail($body['APICEmail'] ?? '');
        $this->setCustomerNote($body['APICNote'] ?? '');
        $this->setCustomerCvrnr($body['APICcvrnr'] ?? '');
        $this->setCustomerCustTypeId(isset($body['APICCustTypeID']) ? (int)$body['APICCustTypeID'] : 0);
        $this->setCustomerEan($body['APICEAN'] ?? '');
        $this->setCustomerRes1($body['APICres1'] ?? '');
        $this->setCustomerRes2($body['APICres2'] ?? '');
        $this->setCustomerRes3($body['APICres3'] ?? '');
        $this->setCustomerRes4($body['APICres4'] ?? '');
        $this->setCustomerRes5($body['APICres5'] ?? '');
        $this->setDeliveryName($body['APIDName'] ?? '');
        $this->setDeliveryCompany($body['APIDCompany'] ?? '');
        $this->setDeliveryAddress($body['APIDAddress'] ?? '');
        $this->setDeliveryAddress2($body['APIDAddress2'] ?? '');
        $this->setDeliveryZipCode($body['APIDZipCode'] ?? '');
        $this->setDeliveryCity($body['APIDCity'] ?? '');
        $this->setDeliveryCountryID(isset($body['APIDCountryID']) ? (int)$body['APIDCountryID'] : 0);
        $this->setDeliveryCountry($body['APIDCountry'] ?? '');
        $this->setDeliveryPhone($body['APIDPhone'] ?? '');
        $this->setDeliveryFax($body['APIDFax'] ?? '');
        $this->setDeliveryEmail($body['APIDEmail'] ?? '');
        $this->setDeliveryEan($body['APIDean'] ?? '');
        $this->setShippingMethod($body['APIShippingMethod'] ?? '');
        $this->setShippingFee(static::currencyStringToFloat($body['APIShippingFee'] ?? '0.00', 'APIShippingFee'));
        $this->setPaymentMethod($body['APIPayMethod'] ?? '');
        $this->setPaymentFee(static::currencyStringToFloat($body['APIPayFee'] ?? '0.00', 'APIPayFee'));
        $this->setCustomerIp($body['APICIP'] ?? '');
        $this->setLoadBalancerRealIp($body['APILoadBalancerRealIP'] ?? '');
        $this->setReferrer($request->hasHeader('referer') ? $request->getHeaderLine('referer') : '');

        // populate order lines
        $i = 1;
        while (true) {
            $exists = isset($body['APIBasketProdAmount'.$i]);
            if ($exists === false) {
                break;
            }

            $qty = isset($body['APIBasketProdAmount'.$i]) ? (int)$body['APIBasketProdAmount'.$i] : 0;
            $productNumber = isset($body['APIBasketProdNumber'.$i]) ? $body['APIBasketProdNumber'.$i] : '';
            $name = isset($body['APIBasketProdName'.$i]) ? $body['APIBasketProdName'.$i] : '';
            $price = isset($body['APIBasketProdPrice'.$i]) ?
                static::currencyStringToFloat($body['APIBasketProdPrice'.$i], 'APIBasketProdPrice'.$i) : 0.00;
            $vat = isset($body['APIBasketProdVAT'.$i]) ? (int)$body['APIBasketProdVAT'.$i] : 0;

            $paymentLine = new PaymentLine();
            $paymentLine
                ->setQuantity($qty)
                ->setProductNumber($productNumber)
                ->setName($name)
                ->setPrice($price)
                ->setVat($vat)
            ;
            $this->addPaymentLine($paymentLine);

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
     * @param string $propertyPath
     * @return float
     */
    public static function currencyStringToFloat(string $str, string $propertyPath = '') : float
    {
        $str = trim($str);

        // verify format of string
        if (!preg_match('/(\.|,)[0-9]{2}$/', $str)) {
            throw new \InvalidArgumentException(($propertyPath ? $propertyPath.' (value: "'.$str.'")' : $str).
                ' does not match the currency string format');
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
     * @return string
     */
    public function getReferrer(): string
    {
        return $this->referrer;
    }

    /**
     * @param string $referrer
     * @return PaymentRequest
     */
    public function setReferrer(string $referrer) : self
    {
        $this->referrer = $referrer;
        return $this;
    }

    /**
     * @return PaymentLine[]|iterable
     */
    public function getPaymentLines() : iterable
    {
        return $this->paymentLines;
    }

    /**
     * @param PaymentLine[]|iterable $paymentLines
     * @return PaymentRequest
     */
    public function setPaymentLines(iterable $paymentLines) : self
    {
        $this->paymentLines = $paymentLines;
        return $this;
    }

    /**
     * @param PaymentLine $paymentLine
     * @return PaymentRequest
     */
    public function addPaymentLine(PaymentLine $paymentLine) : self
    {
        $this->paymentLines[] = $paymentLine;
        return $this;
    }
}
