<?php

namespace Loevgaard\Dandomain\Pay\Helper;

use Loevgaard\Dandomain\Pay\Model\Payment;
use Money\Money;

/**
 * The checksum helper will assist in creating checksums and also verifying checksums based on a payment
 */
class ChecksumHelper
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
     * @var Payment
     */
    protected $payment;

    public function __construct(Payment $payment, string $sharedKey1, string $sharedKey2)
    {
        $this->payment = $payment;
        $this->sharedKey1 = $sharedKey1;
        $this->sharedKey2 = $sharedKey2;
    }

    /**
     * Returns true if the checksum given from Dandomain matches the checksum we can compute.
     *
     * @return bool
     */
    public function checksumMatches(): bool
    {
        return $this->payment->getApiKey() === $this->getChecksum1();
    }

    /**
     * @return string
     */
    public function getChecksum1()
    {
        if (!$this->checksum1) {
            $this->checksum1 = static::generateChecksum1(
                $this->payment->getOrderId(),
                $this->payment->getTotalAmount(),
                $this->sharedKey1,
                $this->payment->getPaymentGatewayCurrencyCode()
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
                $this->payment->getOrderId(),
                $this->sharedKey2,
                $this->payment->getPaymentGatewayCurrencyCode()
            );
        }

        return $this->checksum2;
    }

    /**
     * @param int    $orderId
     * @param Money  $amount
     * @param string $sharedKey
     * @param int    $currency
     *
     * @return string
     */
    public static function generateChecksum1(int $orderId, Money $amount, string $sharedKey, int $currency): string
    {
        $amountAsFloat = (float)$amount->getAmount() / pow(10, 2);

        // the amount needs to be formatted as a danish number, so we convert the float
        $amount = number_format($amountAsFloat, 2, ',', '');

        return strtolower(md5($orderId.'+'.$amount.'+'.$sharedKey.'+'.$currency));
    }

    /**
     * Dandomain has a bug in their payment implementation where they don't
     * include amount in checksum on their complete/success page.
     * That is why we have a second method for computing that checksum.
     *
     * @param int    $orderId
     * @param string $sharedKey
     * @param int    $currency
     *
     * @return string
     */
    public static function generateChecksum2(int $orderId, string $sharedKey, int $currency): string
    {
        return strtolower(md5($orderId.'+'.$sharedKey.'+'.$currency));
    }
}
