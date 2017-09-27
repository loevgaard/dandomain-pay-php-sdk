<?php

namespace Loevgaard\Dandomain\Pay\PaymentRequest;

use Loevgaard\Dandomain\Pay\PaymentRequest;

class PaymentLine
{
    /**
     * @var string
     */
    protected $productNumber;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * The price excl vat
     *
     * @var float
     */
    protected $price;

    /**
     * This is the VAT percentage, i.e. 25 for Denmark
     *
     * @var int
     */
    protected $vat;

    /**
     * @var PaymentRequest
     */
    protected $payment;

    /**
     * @return string
     */
    public function getProductNumber() : string
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     * @return PaymentLine
     */
    public function setProductNumber(string $productNumber) : self
    {
        $this->productNumber = $productNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return PaymentLine
     */
    public function setName($name) : self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity() : int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return PaymentLine
     */
    public function setQuantity($quantity) : self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice() : float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return PaymentLine
     */
    public function setPrice($price) : self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Returns the VAT percentage
     *
     * @return int
     */
    public function getVat() : int
    {
        return $this->vat;
    }

    /**
     * @param int $vat
     * @return PaymentLine
     */
    public function setVat($vat) : self
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return PaymentRequest
     */
    public function getPayment() : PaymentRequest
    {
        return $this->payment;
    }

    /**
     * @param PaymentRequest $payment
     * @return PaymentLine
     */
    public function setPayment(PaymentRequest $payment) : self
    {
        $this->payment = $payment;
        return $this;
    }
}
