<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 11:37 AM
 */

namespace App\Coinbase\Commerce\Model;


class Charge
{
    /** @var string */
    protected $code;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /** @var string */
    protected $hosted_url;

    /** @var string */
    protected $created_at;

    /** @var string */
    protected $expires_at;

    /** @var string */
    protected $confirmed_at;

    /** @var string */
    protected $pricing_type;

    /** @var Addresses */
    protected $addresses;

    /** @var Metadata */
    protected $metadata;

    /** @var Timeline[] */
    protected $timeline;

    /** @var Pricing */
    protected $pricing;

    /** @var Payment[] */
    protected $payments;

    /** @var array */
    protected $json;

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getHostedUrl()
    {
        return $this->hosted_url;
    }

    /**
     * @param string $hosted_url
     */
    public function setHostedUrl(string $hosted_url)
    {
        $this->hosted_url = $hosted_url;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string  $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getExpiresAt(): string
    {
        return $this->expires_at;
    }

    /**
     * @param string $expires_at
     */
    public function setExpiresAt(string $expires_at)
    {
        $this->expires_at = $expires_at;
    }

    /**
     * @return string
     */
    public function getConfirmedAt()
    {
        return $this->confirmed_at;
    }

    /**
     * @param string $confirmed_at
     */
    public function setConfirmedAt(string $confirmed_at)
    {
        $this->confirmed_at = $confirmed_at;
    }

    /**
     * @return string
     */
    public function getPricingType()
    {
        return $this->pricing_type;
    }

    /**
     * @param string $pricing_type
     */
    public function setPricingType(string $pricing_type)
    {
        $this->pricing_type = $pricing_type;
    }

    /**
     * @return Addresses
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param Addresses $addresses
     */
    public function setAddresses(Addresses $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @return Metadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param Metadata $metadata
     */
    public function setMetadata(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * @return Timeline[]
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * @param Timeline[] $timeline
     */
    public function setTimeline(array $timeline)
    {
        $this->timeline = $timeline;
    }

    /**
     * @return Pricing
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * @param Pricing $pricing
     */
    public function setPricing(Pricing $pricing)
    {
        $this->pricing = $pricing;
    }

    /**
     * @return Payment[]
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param Payment[] $payments
     */
    public function setPayments(array $payments)
    {
        $this->payments = $payments;
    }

    /**
     * @return array
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @param array $json
     */
    public function setJson(array $json)
    {
        $this->json = $json;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return  "Name: " . $this->getName() . ", Code:" . $this->getCode() . ", Description: " . $this->getDescription() . ", HostedUrl: " . $this->getHostedUrl() . ", CreatedAt: " . $this->getCreatedAt() .
            ", ExpiresAt: " . $this->getExpiresAt() . ", ConfirmedAt: " . $this->getConfirmedAt() . ", PricingType: " . $this->getPricingType() . ", Addresses: " . $this->getAddresses();
    }
}