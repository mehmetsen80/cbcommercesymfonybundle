<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 12:54 PM
 */

namespace App\Coinbase\Commerce\Model;


class Money
{
    /** @var float */
    protected $amount;

    /** @var  string */
    protected $currency;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Amount: " . $this->getAmount() . ", Currency: " . $this->getCurrency();
    }

}