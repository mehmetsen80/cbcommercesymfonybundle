<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/20/18
 * Time: 4:24 PM
 */

namespace App\Coinbase\Commerce\Model;


class Webhook
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $scheduled_for;

    /** @var Event */
    protected $event;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getScheduledFor(): string
    {
        return $this->scheduled_for;
    }

    /**
     * @param string $scheduled_for
     */
    public function setScheduledFor(string $scheduled_for): void
    {
        $this->scheduled_for = $scheduled_for;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event): void
    {
        $this->event = $event;
    }



}