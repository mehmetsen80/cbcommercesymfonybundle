<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 11:19 AM
 */

namespace App\Coinbase\Commerce\Model;


class Addresses
{
    /** @var string */
    protected $ethereum;
    /** @var string */
    protected $bitcoin;
    /** @var string */
    protected $bitcoincash;
    /** @var string */
    protected $litecoin;

    /**
     * @return string
     */
    public function getEthereum(): string
    {
        return $this->ethereum;
    }

    /**
     * @param string $ethereum
     */
    public function setEthereum(string $ethereum): void
    {
        $this->ethereum = $ethereum;
    }

    /**
     * @return string
     */
    public function getBitcoin(): string
    {
        return $this->bitcoin;
    }

    /**
     * @param string $bitcoin
     */
    public function setBitcoin(string $bitcoin): void
    {
        $this->bitcoin = $bitcoin;
    }

    /**
     * @return string
     */
    public function getBitcoincash(): string
    {
        return $this->bitcoincash;
    }

    /**
     * @param string $bitcoincash
     */
    public function setBitcoincash(string $bitcoincash): void
    {
        $this->bitcoincash = $bitcoincash;
    }

    /**
     * @return string
     */
    public function getLitecoin(): string
    {
        return $this->litecoin;
    }

    /**
     * @param string $litecoin
     */
    public function setLitecoin(string $litecoin): void
    {
        $this->litecoin = $litecoin;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Bitcoin: " . $this->getBitcoin() . " Bitcoincash: " . $this->getBitcoincash() . " Ethereum: " . $this->getEthereum() . " Litecoin: " . $this->getLitecoin();
    }

}