<?php

namespace Loevgaard\Dandomain\Pay;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Handler handles the request from Dandomain, typically a POST request with the order specific parameters
 * and turns that request into a PaymentRequest object
 */
class Handler
{
    /**
     * @var string
     */
    protected $sharedKey1;

    /**
     * @var string
     */
    protected $sharedKey2;

    /**
     * @var PaymentRequest
     */
    protected $paymentRequest;

    public function __construct(Request $request, string $sharedKey1, string $sharedKey2)
    {
        $paymentRequest = new PaymentRequest();
        $paymentRequest->populateFromRequest($request);

        $this->paymentRequest = $paymentRequest;
        $this->sharedKey1 = $sharedKey1;
        $this->sharedKey2 = $sharedKey2;
    }

    /**
     * Returns true if the checksum given from Dandomain matches the checksum we can compute
     *
     * @return bool
     */
    public function checksumMatches() : bool
    {
        return $this->paymentRequest->getApiKey() === static::generateChecksum1(
            $this->paymentRequest->getOrderId(),
            $this->paymentRequest->getTotalAmount(),
            $this->sharedKey1,
            $this->paymentRequest->getPaymentGatewayCurrencyCode()
        );
    }

    /**
     * @param int $orderId
     * @param float $amount
     * @param string $sharedKey
     * @param int $currency
     * @return string
     */
    public static function generateChecksum1(int $orderId, float $amount, string $sharedKey, int $currency) : string
    {
        // the amount needs to be formatted as a danish number, so we convert the float
        $amount = number_format($amount, 2, ',', '');
        return strtolower(md5($orderId.'+'.$amount.'+'.$sharedKey.'+'.$currency));
    }

    /**
     * Dandomain has a bug in their payment implementation where they don't
     * include amount in checksum on their complete/success page.
     * That is why we have a second method for computing that checksum
     *
     * @param int $orderId
     * @param string $sharedKey
     * @param int $currency
     * @return string
     */
    public static function generateChecksum2(int $orderId, string $sharedKey, int $currency) : string
    {
        return strtolower(md5($orderId.'+'.$sharedKey.'+'.$currency));
    }

    /**
     * @return PaymentRequest
     */
    public function getPaymentRequest() : PaymentRequest
    {
        return $this->paymentRequest;
    }

    /**
     * @param PaymentRequest $paymentRequest
     * @return Handler
     */
    public function setPaymentRequest(PaymentRequest $paymentRequest) : self
    {
        $this->paymentRequest = $paymentRequest;
        return $this;
    }
}
