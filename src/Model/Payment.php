<?php

namespace Loevgaard\Dandomain\Pay\Model;

use Money\Currency;
use Money\Money;
use Psr\Http\Message\ServerRequestInterface;

class Payment
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
     * @var Money
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
     * @var bool
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
     * @var int
     */
    protected $shippingMethodId;

    /**
     * @var Money
     */
    protected $shippingFee;

    /**
     * @var string
     */
    protected $paymentMethod;

    /**
     * @var int
     */
    protected $paymentMethodId;

    /**
     * @var Money
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

    public static function createFromRequest(ServerRequestInterface $request) : Payment
    {
        $body = $request->getParsedBody();
        $body = is_array($body) ? $body : [];

        $payment = new static();
        $currency = new Currency($body['APICurrencySymbol']);

        $payment->setApiKey($body['APIkey'] ?? '');
        $payment->setMerchant($body['APIMerchant'] ?? '');
        $payment->setOrderId($body['APIOrderID'] ?? 0);
        $payment->setSessionId($body['APISessionID'] ?? '');
        $payment->setCurrencySymbol($body['APICurrencySymbol'] ?? '');
        $payment->setTotalAmount(new Money(static::priceStringToInt($body['APITotalAmount'] ?? '0.00', 'APITotalAmount'), $currency));
        $payment->setCallBackUrl($body['APICallBackUrl'] ?? '');
        $payment->setFullCallBackOkUrl($body['APIFullCallBackOKUrl'] ?? '');
        $payment->setCallBackOkUrl($body['APICallBackOKUrl'] ?? '');
        $payment->setCallBackServerUrl($body['APICallBackServerUrl'] ?? '');
        $payment->setLanguageId(isset($body['APILanguageID']) ? (int) $body['APILanguageID'] : 0);
        $payment->setTestMode(isset($body['APITestMode']) && 'True' === $body['APITestMode']);
        $payment->setPaymentGatewayCurrencyCode(isset($body['APIPayGatewayCurrCode']) ? (int) $body['APIPayGatewayCurrCode'] : 0);
        $payment->setCardTypeId(isset($body['APICardTypeID']) ? (int) $body['APICardTypeID'] : 0);
        $payment->setCustomerRekvNr($body['APICRekvNr'] ?? '');
        $payment->setCustomerName($body['APICName'] ?? '');
        $payment->setCustomerCompany($body['APICCompany'] ?? '');
        $payment->setCustomerAddress($body['APICAddress'] ?? '');
        $payment->setCustomerAddress2($body['APICAddress2'] ?? '');
        $payment->setCustomerZipCode($body['APICZipCode'] ?? '');
        $payment->setCustomerCity($body['APICCity'] ?? '');
        $payment->setCustomerCountryId(isset($body['APICCountryID']) ? (int) $body['APICCountryID'] : 0);
        $payment->setCustomerCountry($body['APICCountry'] ?? '');
        $payment->setCustomerPhone($body['APICPhone'] ?? '');
        $payment->setCustomerFax($body['APICFax'] ?? '');
        $payment->setCustomerEmail($body['APICEmail'] ?? '');
        $payment->setCustomerNote($body['APICNote'] ?? '');
        $payment->setCustomerCvrnr($body['APICcvrnr'] ?? '');
        $payment->setCustomerCustTypeId(isset($body['APICCustTypeID']) ? (int) $body['APICCustTypeID'] : 0);
        $payment->setCustomerEan($body['APICEAN'] ?? '');
        $payment->setCustomerRes1($body['APICres1'] ?? '');
        $payment->setCustomerRes2($body['APICres2'] ?? '');
        $payment->setCustomerRes3($body['APICres3'] ?? '');
        $payment->setCustomerRes4($body['APICres4'] ?? '');
        $payment->setCustomerRes5($body['APICres5'] ?? '');
        $payment->setDeliveryName($body['APIDName'] ?? '');
        $payment->setDeliveryCompany($body['APIDCompany'] ?? '');
        $payment->setDeliveryAddress($body['APIDAddress'] ?? '');
        $payment->setDeliveryAddress2($body['APIDAddress2'] ?? '');
        $payment->setDeliveryZipCode($body['APIDZipCode'] ?? '');
        $payment->setDeliveryCity($body['APIDCity'] ?? '');
        $payment->setDeliveryCountryID(isset($body['APIDCountryID']) ? (int) $body['APIDCountryID'] : 0);
        $payment->setDeliveryCountry($body['APIDCountry'] ?? '');
        $payment->setDeliveryPhone($body['APIDPhone'] ?? '');
        $payment->setDeliveryFax($body['APIDFax'] ?? '');
        $payment->setDeliveryEmail($body['APIDEmail'] ?? '');
        $payment->setDeliveryEan($body['APIDean'] ?? '');
        $payment->setShippingMethod($body['APIShippingMethod'] ?? '');
        $payment->setShippingMethodId(isset($body['APIShippingMethodID']) ? (int)$body['APIShippingMethodID'] : 0);
        $payment->setShippingFee(new Money(static::priceStringToInt($body['APIShippingFee'] ?? '0.00', 'APIShippingFee'), $currency));
        $payment->setPaymentMethod($body['APIPayMethod'] ?? '');
        $payment->setPaymentMethodId(isset($body['APIPayMethodID']) ? (int)$body['APIPayMethodID'] : 0);
        $payment->setPaymentFee(new Money(static::priceStringToInt($body['APIPayFee'] ?? '0.00', 'APIPayFee'), $currency));
        $payment->setCustomerIp($body['APICIP'] ?? '');
        $payment->setLoadBalancerRealIp($body['APILoadBalancerRealIP'] ?? '');
        $payment->setReferrer($request->hasHeader('referer') ? $request->getHeaderLine('referer') : '');

        // populate order lines
        $i = 1;
        while (isset($body['APIBasketProdAmount'.$i])) {
            $qty = (int) $body['APIBasketProdAmount'.$i];
            $productNumber = $body['APIBasketProdNumber'.$i] ?? '';
            $name = $body['APIBasketProdName'.$i] ?? '';
            $price = new Money(static::priceStringToInt($body['APIBasketProdPrice'.$i] ?? '0.00', 'APIBasketProdPrice'.$i), $currency);
            $vat = isset($body['APIBasketProdVAT'.$i]) ? (int) $body['APIBasketProdVAT'.$i] : 0;

            $payment->addPaymentLine(static::createPaymentLine($productNumber, $name, $qty, $price, $vat));

            ++$i;
        }

        return $payment;
    }

    /**
     * Takes strings like
     * - 1.000,50
     * - 1,000.50
     * - 1000.50
     * - 1000,50.
     *
     * and returns 100050
     *
     * @param string $str
     * @param string $propertyPath
     *
     * @return int
     */
    public static function priceStringToInt(string $str, string $propertyPath = '') : int
    {
        $str = trim($str);

        // verify format of string
        if (!preg_match('/(\.|,)[0-9]{2}$/', $str)) {
            throw new \InvalidArgumentException(($propertyPath ? $propertyPath.' (value: "'.$str.'")' : $str).
                ' does not match the currency string format');
        }
        $str = preg_replace('/[^0-9]+/', '', $str);

        return intval($str);
    }

    public static function createPaymentLine(string $productNumber, string $name, int $quantity, Money $price, int $vat)
    {
        return new PaymentLine($productNumber, $name, $quantity, $price, $vat);
    }

    /**
     * @return string
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return Payment
     */
    public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getMerchant(): ?string
    {
        return $this->merchant;
    }

    /**
     * @param string $merchant
     *
     * @return Payment
     */
    public function setMerchant(string $merchant): self
    {
        $this->merchant = $merchant;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    /**
     * @param int $orderId
     *
     * @return Payment
     */
    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * @return string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @param string $sessionId
     *
     * @return Payment
     */
    public function setSessionId(string $sessionId): self
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencySymbol(): ?string
    {
        return $this->currencySymbol;
    }

    /**
     * @param string $currencySymbol
     *
     * @return Payment
     */
    public function setCurrencySymbol(string $currencySymbol): self
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }

    /**
     * @return Money
     */
    public function getTotalAmount(): ?Money
    {
        return $this->totalAmount;
    }

    /**
     * @param Money $totalAmount
     *
     * @return Payment
     */
    public function setTotalAmount(Money $totalAmount): self
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackUrl(): ?string
    {
        return $this->callBackUrl;
    }

    /**
     * @param string $callBackUrl
     *
     * @return Payment
     */
    public function setCallBackUrl(string $callBackUrl): self
    {
        $this->callBackUrl = $callBackUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getFullCallBackOkUrl(): ?string
    {
        return $this->fullCallBackOkUrl;
    }

    /**
     * @param string $fullCallBackOkUrl
     *
     * @return Payment
     */
    public function setFullCallBackOkUrl(string $fullCallBackOkUrl): self
    {
        $this->fullCallBackOkUrl = $fullCallBackOkUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackOkUrl(): ?string
    {
        return $this->callBackOkUrl;
    }

    /**
     * @param string $callBackOkUrl
     *
     * @return Payment
     */
    public function setCallBackOkUrl(string $callBackOkUrl): self
    {
        $this->callBackOkUrl = $callBackOkUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallBackServerUrl(): ?string
    {
        return $this->callBackServerUrl;
    }

    /**
     * @param string $callBackServerUrl
     *
     * @return Payment
     */
    public function setCallBackServerUrl(string $callBackServerUrl): self
    {
        $this->callBackServerUrl = $callBackServerUrl;

        return $this;
    }

    /**
     * @return int
     */
    public function getLanguageId(): ?int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     *
     * @return Payment
     */
    public function setLanguageId(int $languageId): self
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTestMode(): ?bool
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     *
     * @return Payment
     */
    public function setTestMode(bool $testMode): self
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
     *
     * @return Payment
     */
    public function setPaymentGatewayCurrencyCode(int $paymentGatewayCurrencyCode): self
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
     *
     * @return Payment
     */
    public function setCardTypeId(int $cardTypeId): self
    {
        $this->cardTypeId = $cardTypeId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRekvNr(): ?string
    {
        return $this->customerRekvNr;
    }

    /**
     * @param string $customerRekvNr
     *
     * @return Payment
     */
    public function setCustomerRekvNr(string $customerRekvNr): self
    {
        $this->customerRekvNr = $customerRekvNr;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName(): ?string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     *
     * @return Payment
     */
    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCompany(): ?string
    {
        return $this->customerCompany;
    }

    /**
     * @param string $customerCompany
     *
     * @return Payment
     */
    public function setCustomerCompany(string $customerCompany): self
    {
        $this->customerCompany = $customerCompany;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerAddress(): ?string
    {
        return $this->customerAddress;
    }

    /**
     * @param string $customerAddress
     *
     * @return Payment
     */
    public function setCustomerAddress(string $customerAddress): self
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerAddress2(): ?string
    {
        return $this->customerAddress2;
    }

    /**
     * @param string $customerAddress2
     *
     * @return Payment
     */
    public function setCustomerAddress2(string $customerAddress2): self
    {
        $this->customerAddress2 = $customerAddress2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerZipCode(): ?string
    {
        return $this->customerZipCode;
    }

    /**
     * @param string $customerZipCode
     *
     * @return Payment
     */
    public function setCustomerZipCode(string $customerZipCode): self
    {
        $this->customerZipCode = $customerZipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCity(): ?string
    {
        return $this->customerCity;
    }

    /**
     * @param string $customerCity
     *
     * @return Payment
     */
    public function setCustomerCity(string $customerCity): self
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
     *
     * @return Payment
     */
    public function setCustomerCountryId(int $customerCountryId): self
    {
        $this->customerCountryId = $customerCountryId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCountry(): ?string
    {
        return $this->customerCountry;
    }

    /**
     * @param string $customerCountry
     *
     * @return Payment
     */
    public function setCustomerCountry(string $customerCountry): self
    {
        $this->customerCountry = $customerCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     *
     * @return Payment
     */
    public function setCustomerPhone(string $customerPhone): self
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerFax(): ?string
    {
        return $this->customerFax;
    }

    /**
     * @param string $customerFax
     *
     * @return Payment
     */
    public function setCustomerFax(string $customerFax): self
    {
        $this->customerFax = $customerFax;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    /**
     * @param string $customerEmail
     *
     * @return Payment
     */
    public function setCustomerEmail(string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerNote(): ?string
    {
        return $this->customerNote;
    }

    /**
     * @param string $customerNote
     *
     * @return Payment
     */
    public function setCustomerNote(string $customerNote): self
    {
        $this->customerNote = $customerNote;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerCvrnr(): ?string
    {
        return $this->customerCvrnr;
    }

    /**
     * @param string $customerCvrnr
     *
     * @return Payment
     */
    public function setCustomerCvrnr(string $customerCvrnr): self
    {
        $this->customerCvrnr = $customerCvrnr;

        return $this;
    }

    /**
     * @return int
     */
    public function getCustomerCustTypeId(): ?int
    {
        return $this->customerCustTypeId;
    }

    /**
     * @param int $customerCustTypeId
     *
     * @return Payment
     */
    public function setCustomerCustTypeId(int $customerCustTypeId): self
    {
        $this->customerCustTypeId = $customerCustTypeId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerEan(): ?string
    {
        return $this->customerEan;
    }

    /**
     * @param string $customerEan
     *
     * @return Payment
     */
    public function setCustomerEan(string $customerEan): self
    {
        $this->customerEan = $customerEan;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes1(): ?string
    {
        return $this->customerRes1;
    }

    /**
     * @param string $customerRes1
     *
     * @return Payment
     */
    public function setCustomerRes1(string $customerRes1): self
    {
        $this->customerRes1 = $customerRes1;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes2(): ?string
    {
        return $this->customerRes2;
    }

    /**
     * @param string $customerRes2
     *
     * @return Payment
     */
    public function setCustomerRes2(string $customerRes2): self
    {
        $this->customerRes2 = $customerRes2;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes3(): ?string
    {
        return $this->customerRes3;
    }

    /**
     * @param string $customerRes3
     *
     * @return Payment
     */
    public function setCustomerRes3(string $customerRes3): self
    {
        $this->customerRes3 = $customerRes3;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes4(): ?string
    {
        return $this->customerRes4;
    }

    /**
     * @param string $customerRes4
     *
     * @return Payment
     */
    public function setCustomerRes4(string $customerRes4): self
    {
        $this->customerRes4 = $customerRes4;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerRes5(): ?string
    {
        return $this->customerRes5;
    }

    /**
     * @param string $customerRes5
     *
     * @return Payment
     */
    public function setCustomerRes5(string $customerRes5): self
    {
        $this->customerRes5 = $customerRes5;

        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerIp(): ?string
    {
        return $this->customerIp;
    }

    /**
     * @param string $customerIp
     *
     * @return Payment
     */
    public function setCustomerIp(string $customerIp): self
    {
        $this->customerIp = $customerIp;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryName(): ?string
    {
        return $this->deliveryName;
    }

    /**
     * @param string $deliveryName
     *
     * @return Payment
     */
    public function setDeliveryName(string $deliveryName): self
    {
        $this->deliveryName = $deliveryName;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCompany(): ?string
    {
        return $this->deliveryCompany;
    }

    /**
     * @param string $deliveryCompany
     *
     * @return Payment
     */
    public function setDeliveryCompany(string $deliveryCompany): self
    {
        $this->deliveryCompany = $deliveryCompany;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $deliveryAddress
     *
     * @return Payment
     */
    public function setDeliveryAddress(string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress2(): ?string
    {
        return $this->deliveryAddress2;
    }

    /**
     * @param string $deliveryAddress2
     *
     * @return Payment
     */
    public function setDeliveryAddress2(string $deliveryAddress2): self
    {
        $this->deliveryAddress2 = $deliveryAddress2;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryZipCode(): ?string
    {
        return $this->deliveryZipCode;
    }

    /**
     * @param string $deliveryZipCode
     *
     * @return Payment
     */
    public function setDeliveryZipCode(string $deliveryZipCode): self
    {
        $this->deliveryZipCode = $deliveryZipCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCity(): ?string
    {
        return $this->deliveryCity;
    }

    /**
     * @param string $deliveryCity
     *
     * @return Payment
     */
    public function setDeliveryCity(string $deliveryCity): self
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
     *
     * @return Payment
     */
    public function setDeliveryCountryID(int $deliveryCountryID): self
    {
        $this->deliveryCountryID = $deliveryCountryID;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCountry(): ?string
    {
        return $this->deliveryCountry;
    }

    /**
     * @param string $deliveryCountry
     *
     * @return Payment
     */
    public function setDeliveryCountry(string $deliveryCountry): self
    {
        $this->deliveryCountry = $deliveryCountry;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryPhone(): ?string
    {
        return $this->deliveryPhone;
    }

    /**
     * @param string $deliveryPhone
     *
     * @return Payment
     */
    public function setDeliveryPhone(string $deliveryPhone): self
    {
        $this->deliveryPhone = $deliveryPhone;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryFax(): ?string
    {
        return $this->deliveryFax;
    }

    /**
     * @param string $deliveryFax
     *
     * @return Payment
     */
    public function setDeliveryFax(string $deliveryFax): self
    {
        $this->deliveryFax = $deliveryFax;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryEmail(): ?string
    {
        return $this->deliveryEmail;
    }

    /**
     * @param string $deliveryEmail
     *
     * @return Payment
     */
    public function setDeliveryEmail(string $deliveryEmail): self
    {
        $this->deliveryEmail = $deliveryEmail;

        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryEan(): ?string
    {
        return $this->deliveryEan;
    }

    /**
     * @param string $deliveryEan
     *
     * @return Payment
     */
    public function setDeliveryEan(string $deliveryEan): self
    {
        $this->deliveryEan = $deliveryEan;

        return $this;
    }

    /**
     * @return string
     */
    public function getShippingMethod(): ?string
    {
        return $this->shippingMethod;
    }

    /**
     * @param string $shippingMethod
     *
     * @return Payment
     */
    public function setShippingMethod(string $shippingMethod): self
    {
        $this->shippingMethod = $shippingMethod;

        return $this;
    }

    /**
     * @return int
     */
    public function getShippingMethodId(): ?int
    {
        return $this->shippingMethodId;
    }

    /**
     * @param int $shippingMethodId
     * @return Payment
     */
    public function setShippingMethodId(int $shippingMethodId) : self
    {
        $this->shippingMethodId = $shippingMethodId;
        return $this;
    }

    /**
     * @return Money
     */
    public function getShippingFee(): ?Money
    {
        return $this->shippingFee;
    }

    /**
     * @param Money $shippingFee
     *
     * @return Payment
     */
    public function setShippingFee(Money $shippingFee): self
    {
        $this->shippingFee = $shippingFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     *
     * @return Payment
     */
    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentMethodId(): ?int
    {
        return $this->paymentMethodId;
    }

    /**
     * @param int $paymentMethodId
     * @return Payment
     */
    public function setPaymentMethodId(int $paymentMethodId) : self
    {
        $this->paymentMethodId = $paymentMethodId;
        return $this;
    }

    /**
     * @return Money
     */
    public function getPaymentFee(): ?Money
    {
        return $this->paymentFee;
    }

    /**
     * @param Money $paymentFee
     *
     * @return Payment
     */
    public function setPaymentFee(Money $paymentFee): self
    {
        $this->paymentFee = $paymentFee;

        return $this;
    }

    /**
     * @return string
     */
    public function getLoadBalancerRealIp(): ?string
    {
        return $this->loadBalancerRealIp;
    }

    /**
     * @param string $loadBalancerRealIp
     *
     * @return Payment
     */
    public function setLoadBalancerRealIp(string $loadBalancerRealIp): self
    {
        $this->loadBalancerRealIp = $loadBalancerRealIp;

        return $this;
    }

    /**
     * @return string
     */
    public function getReferrer(): ?string
    {
        return $this->referrer;
    }

    /**
     * @param string $referrer
     *
     * @return Payment
     */
    public function setReferrer(string $referrer): self
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * @return PaymentLine[]|iterable
     */
    public function getPaymentLines(): iterable
    {
        return $this->paymentLines;
    }

    /**
     * @param PaymentLine[]|iterable $paymentLines
     *
     * @return Payment
     */
    public function setPaymentLines(iterable $paymentLines): self
    {
        $this->paymentLines = $paymentLines;

        return $this;
    }

    /**
     * @param PaymentLine $paymentLine
     *
     * @return Payment
     */
    public function addPaymentLine(PaymentLine $paymentLine): self
    {
        $paymentLine->setPayment($this);
        $this->paymentLines[] = $paymentLine;

        return $this;
    }
}
