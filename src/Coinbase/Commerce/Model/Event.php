<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/20/18
 * Time: 4:25 PM
 */

namespace App\Coinbase\Commerce\Model;


class Event
{
    /** @var string */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $api_version;

    /** @var string */
    protected $created_at;

    /** @var Charge */
    protected $data;




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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->api_version;
    }

    /**
     * @param string $api_version
     */
    public function setApiVersion(string $api_version): void
    {
        $this->api_version = $api_version;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return Charge
     */
    public function getData(): Charge
    {
        return $this->data;
    }

    /**
     * @param Charge $data
     */
    public function setData(Charge $data): void
    {
        $this->data = $data;
    }
}