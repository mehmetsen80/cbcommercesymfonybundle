<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 1:05 PM
 */

namespace App\Coinbase\Commerce\Model;


class Value
{
    /** @var Money */
    protected $local;

    /** @var Money */
    protected $crypto;

    /**
     * @return Money
     */
    public function getLocal(): Money
    {
        return $this->local;
    }

    /**
     * @param Money $local
     */
    public function setLocal(Money $local): void
    {
        $this->local = $local;
    }

    /**
     * @return Money
     */
    public function getCrypto(): Money
    {
        return $this->crypto;
    }

    /**
     * @param Money $crypto
     */
    public function setCrypto(Money $crypto): void
    {
        $this->crypto = $crypto;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Local: " . $this->getLocal() . ", Crypto: " . $this->getCrypto();
    }
}