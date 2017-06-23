<?php

namespace Loevgaard\Dandomain\Pay\PaymentRequest;

class OrderLine
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
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $vat;

    /**
     * @return string
     */
    public function getProductNumber() : string
    {
        return $this->productNumber;
    }

    /**
     * @param string $productNumber
     * @return OrderLine
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
     * @return OrderLine
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
     * @return OrderLine
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
     * @return OrderLine
     */
    public function setPrice($price) : self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getVat() : float
    {
        return $this->vat;
    }

    /**
     * @param float $vat
     * @return OrderLine
     */
    public function setVat($vat) : self
    {
        $this->vat = $vat;
        return $this;
    }
}
