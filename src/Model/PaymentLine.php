<?php

namespace Loevgaard\Dandomain\Pay\Model;

use Brick\Math\BigDecimal;
use Money\Money;

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
     * @var Money
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

    /**
     * @param string $productNumber
     * @param string $name
     * @param int $quantity
     * @param Money $price
     * @param int $vat
     */
    public function __construct(string $productNumber, string $name, int $quantity, Money $price, int $vat)
    {
        $this->setProductNumber($productNumber)
            ->setName($name)
            ->setQuantity($quantity)
            ->setPrice($price)
            ->setVat($vat);
    }

    /******************
     * Helper methods *
     *****************/

    /**
     * @return Money
     */
    public function getPriceExclVat(): Money
    {
        return $this->getPrice();
    }

    /**
     * @return Money
     */
    public function getPriceInclVat(): Money
    {
        return $this->price
            ->multiply(100 + $this->getVat())
            ->divide(100)
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
    public function setName(string $name): self
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
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Returns the price excl vat.
     *
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

    /**
     * @param Money $price
     *
     * @return PaymentLine
     */
    public function setPrice(Money $price): self
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
    public function setVat(int $vat): self
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
