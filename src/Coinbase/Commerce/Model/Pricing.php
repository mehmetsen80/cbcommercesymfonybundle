<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 12:56 PM
 */

namespace App\Coinbase\Commerce\Model;


class Pricing
{
    /** @var Money */
    protected $local;

    /** @var Money */
    protected $ethereum;

    /** @var Money */
    protected $bitcoin;

    /** @var Money */
    protected $bitcoincash;

    /** @var Money */
    protected $litecoin;

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
    public function getEthereum(): Money
    {
        return $this->ethereum;
    }

    /**
     * @param Money $ethereum
     */
    public function setEthereum(Money $ethereum): void
    {
        $this->ethereum = $ethereum;
    }

    /**
     * @return Money
     */
    public function getBitcoin(): Money
    {
        return $this->bitcoin;
    }

    /**
     * @param Money $bitcoin
     */
    public function setBitcoin(Money $bitcoin): void
    {
        $this->bitcoin = $bitcoin;
    }

    /**
     * @return Money
     */
    public function getBitcoincash(): Money
    {
        return $this->bitcoincash;
    }

    /**
     * @param Money $bitcoincash
     */
    public function setBitcoincash(Money $bitcoincash): void
    {
        $this->bitcoincash = $bitcoincash;
    }

    /**
     * @return Money
     */
    public function getLitecoin(): Money
    {
        return $this->litecoin;
    }

    /**
     * @param Money $litecoin
     */
    public function setLitecoin(Money $litecoin): void
    {
        $this->litecoin = $litecoin;
    }

}