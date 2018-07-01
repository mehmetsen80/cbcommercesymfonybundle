<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 1:01 PM
 */

namespace App\Coinbase\Commerce\Model;


class Payment
{
    /** @var string */
    protected $network;

    /** @var string */
    protected $transaction_id;

    /** @var string */
    protected $status;

    /** @var Value */
    protected $value;

    /** @var Block */
    protected $block;

    /**
     * @return string
     */
    public function getNetwork(): string
    {
        return $this->network;
    }

    /**
     * @param string $network
     */
    public function setNetwork(string $network): void
    {
        $this->network = $network;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    /**
     * @param string $transaction_id
     */
    public function setTransactionId(string $transaction_id): void
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Value
     */
    public function getValue(): Value
    {
        return $this->value;
    }

    /**
     * @param Value $value
     */
    public function setValue(Value $value): void
    {
        $this->value = $value;
    }

    /**
     * @return Block
     */
    public function getBlock(): Block
    {
        return $this->block;
    }

    /**
     * @param Block $block
     */
    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Network: " . $this->getNetwork() . ", TransactionId: " . $this->getTransactionId() . ", Status: " . $this->getStatus() . ", Value: " . $this->getValue() . ", Block: " . $this->getBlock();
    }
}