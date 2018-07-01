<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 11:40 AM
 */

namespace App\Coinbase\Commerce\Model;


class Timeline
{
    /** @var string */
    protected $status;

    /** @var string */
    protected $time;

    /** @var Payment */
    protected $payment;

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
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
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
     */
    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "Status: " . $this->getStatus() . ", Time: " .  $this->getTime() . " Payment: " . $this->getPayment();
    }

}