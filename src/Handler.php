<?php

namespace Loevgaard\Dandomain\Pay;

use Psr\Http\Message\ServerRequestInterface;

/**
 * The Handler handles the request from Dandomain, typically a POST request with the order specific parameters
 * and turns that request into a PaymentRequest object
 *
 * Also it provides helper methods for checking checksums
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
     * @var string
     */
    protected $checksum1;

    /**
     * @var string
     */
    protected $checksum2;

    /**
     * @var PaymentRequest
     */
    protected $paymentRequest;

    public function __construct(ServerRequestInterface $request, string $sharedKey1, string $sharedKey2)
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
        return $this->paymentRequest->getApiKey() === $this->getChecksum1();
    }

    /**
     * @return string
     */
    public function getChecksum1()
    {
        if (!$this->checksum1) {
            $this->checksum1 = static::generateChecksum1(
                $this->paymentRequest->getOrderId(),
                $this->paymentRequest->getTotalAmount(),
                $this->sharedKey1,
                $this->paymentRequest->getPaymentGatewayCurrencyCode()
            );
        }

        return $this->checksum1;
    }

    /**
     * @return string
     */
    public function getChecksum2()
    {
        if (!$this->checksum2) {
            $this->checksum2 = static::generateChecksum2(
                $this->paymentRequest->getOrderId(),
                $this->sharedKey2,
                $this->paymentRequest->getPaymentGatewayCurrencyCode()
            );
        }

        return $this->checksum2;
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
