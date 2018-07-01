<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 3:40 PM
 */

namespace App\Coinbase\Commerce\Model;


class Block
{
    /** @var integer */
    protected $height;

    /** @var string */
    protected $hash;

    /** @var integer */
    protected $confirmations;

    /** @var integer */
    protected $confirmations_required;

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return int
     */
    public function getConfirmations(): int
    {
        return $this->confirmations;
    }

    /**
     * @param int $confirmations
     */
    public function setConfirmations(int $confirmations): void
    {
        $this->confirmations = $confirmations;
    }

    /**
     * @return int
     */
    public function getConfirmationsRequired(): int
    {
        return $this->confirmations_required;
    }

    /**
     * @param int $confirmations_required
     */
    public function setConfirmationsRequired(int $confirmations_required): void
    {
        $this->confirmations_required = $confirmations_required;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Height: " . $this->getHeight() . ", Hash: " . $this->getHash() . " Confirmation: " . $this->getConfirmations() . " ConfirmationsRequired: " . $this->getConfirmationsRequired();
    }

}