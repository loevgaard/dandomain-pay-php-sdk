<?php

namespace Loevgaard\Dandomain\Pay\Model;

use Brick\Math\BigDecimal;

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
     * The price excl vat.
     *
     * @var float
     */
    protected $price;

    /**
     * This is the VAT percentage, i.e. 25 for Denmark.
     *
     * @var int
     */
    protected $vat;

    /**
     * @var Payment
     */
    protected $payment;

    /******************
     * Helper methods *
     *****************/

    /**
     * @return float
     */
    public function getPriceExclVat(): float
    {
        return $this->getPrice();
    }

    /**
     * @return float
     */
    public function getPriceInclVat(): float
    {
        $price = BigDecimal::of($this->getPrice());

        return $price
            ->multipliedBy(100 + $this->getVat())
            ->dividedBy(100, 2)
            ->toFloat()
        ;
    }

    /*********************
     * Getters / Setters *
     ********************/

    /**
     * @return string
     */
    public function getProductNumber(): string
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     *
     * @return PaymentLine
     */
    public function setProductNumber(string $productNumber): self
    {
        $this->productNumber = $productNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return PaymentLine
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     *
     * @return PaymentLine
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Returns the price excl vat.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return PaymentLine
     */
    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Returns the VAT percentage.
     *
     * @return int
     */
    public function getVat(): int
    {
        return $this->vat;
    }

    /**
     * @param int $vat
     *
     * @return PaymentLine
     */
    public function setVat($vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     *
     * @return PaymentLine
     */
    public function setPayment(Payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }
}
