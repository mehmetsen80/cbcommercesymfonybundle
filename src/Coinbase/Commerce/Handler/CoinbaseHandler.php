<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 6/19/18
 * Time: 1:18 PM
 */

namespace App\Coinbase\Commerce\Handler;



use App\Coinbase\Commerce\Model\Addresses;
use App\Coinbase\Commerce\Api\CommerceClient;
use App\Coinbase\Commerce\Model\Block;
use App\Coinbase\Commerce\Model\Charge;
use App\Coinbase\Commerce\Model\Charges;
use App\Coinbase\Commerce\Model\Event;
use App\Coinbase\Commerce\Model\Metadata;
use App\Coinbase\Commerce\Model\Money;
use App\Coinbase\Commerce\Model\Pagination;
use App\Coinbase\Commerce\Model\Payment;
use App\Coinbase\Commerce\Model\Pricing;
use App\Coinbase\Commerce\Model\Timeline;
use App\Coinbase\Commerce\Model\Webhook;
use App\Coinbase\Commerce\Model\Value;
use App\Coinbase\Commerce\Util\Castable;



class CoinbaseHandler
{
    /**
     * @var CommerceClient
     */
    protected $commerceClient;

    /**
     * @var string
     */
    const EVENT_TYPE_CREATED = 'charge:created';

    /**
     * @var string
     */
    const EVENT_TYPE_CONFIRMED = 'charge:confirmed';

    /**
     * @var string
     */
    const EVENT_TYPE_FAILED = 'charge:failed';

    /**
     * CoinbaseHandler constructor.
     */
    public function __construct(string $apikey, string $version, string $webhooksecret)
    {
        try{
            $this->commerceClient = new CommerceClient($apikey, $version, $webhooksecret);

        }catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    /**
     * @param $input
     * @return Charge|null
     * @throws \Exception
     */
    public function createNewCharge($input){

        $charge = null;

        //if input is an instance of Charge object
        //let's convert the Charge instance to json array
        if(is_object($input) && $input instanceof Charge){
            $json = json_encode($input);//first convert into json
            $input = json_decode($json,true);//then convert into json array
        }else if(is_string($input) && is_array(json_decode($input, true))){//if json string, then convert it into json array
            $input = json_decode($input, true);
        }

        //if the input is still not an array then return null
        if(!is_array($input)) return null;

        try{
            //we only accept json array
            $jsonString = $this->commerceClient->createNewCharge($input);
            $charge = $this->parseCharge($jsonString);
        }catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        return $charge;
    }

    /**
     * @param $jsonString
     * @return Webhook|object
     */
    public function parseWebhook($jsonString){


        $json = json_decode($jsonString);

        //do nothing if nil
        if(is_null($json)) return null;


        /**
         * 1-)
         * Create the main Webhook object
         * @var Webhook $webhook
         */
        $webhook = Castable::cast(new Webhook(), $json);

        /**
         * 2-)
         * Event object
         * @var Event $event
         */
        $event = Castable::cast(new Event(), $json->event);

        /**
         * 3-)
         * Charge object
         * @var Charge $data
         */
        $data = $this->parseCharge (json_encode($json->event->data));
        $event->setData($data);

        /**
         * 4-)
         * Event object is ready to set
         */
        $webhook->setEvent($event);

        return $webhook;
    }


    /**
     * @param $jsonString
     * @return Charge|null;
     */
    public function parseCharge($jsonString): Charge {

        $json = json_decode($jsonString);
        $jsonArray = json_decode($jsonString, true);

        //do nothing if nil
        if(is_null($json)) return null;

        $json =  property_exists($json, 'data') ? $json->data : $json;

        /**
         * 1-)
         * Create the Main CoinbaseCharge object
         * @var Charge $charge
         */
        $charge = Castable::cast(new Charge(), $json);
        $charge->setRawJson($jsonArray);

        /**
         * 2-)
         * Addresses object
         * @var Addresses $addresses
         */
        $addresses = Castable::cast(new Addresses(), $json->addresses);
        $charge->setAddresses($addresses);


        /**
         * 3-)
         * Timeline array
         * @var Timeline[] $timelineArr
         */
        $timelineArr  = array();
        foreach ($json->timeline as $item){
            /** @var Timeline $timeline */
            $timeline = Castable::cast(new Timeline(), $item);

            if(property_exists($item,'payment')){
                /** @var Payment $payment */
                $payment = Castable::cast(new Payment(), $item->payment);
                $timeline->setPayment($payment);
            }

            $timelineArr[] = $timeline;
        }
        $charge->setTimeline($timelineArr);


        /*****
         * 4-)
         * Pricing
         *******/
        if(property_exists($json, 'pricing')){

            /**
             * Pricing object
             * @var Pricing $pricing
             */
            $pricing = Castable::cast(new Pricing(), $json->pricing);
            //local
            if(property_exists($pricing, 'local')){
                /** @var Money $moneyLocal */
                $moneyLocal = Castable::cast(new Money(), $json->pricing->local);
                $pricing->setLocal($moneyLocal);
            }
            //ethereum
            if(property_exists($pricing, 'ethereum')){
                /** @var Money $moneyEthereum */
                $moneyEthereum = Castable::cast(new Money(), $json->pricing->ethereum);
                $pricing->setEthereum($moneyEthereum);
            }
            //bitcoin
            if(property_exists($pricing, 'bitcoin')){
                /** @var Money $moneyBitcoin */
                $moneyBitcoin = Castable::cast(new Money(), $json->pricing->bitcoin);
                $pricing->setBitcoin($moneyBitcoin);
            }
            //bitcoincash
            if(property_exists($pricing, 'bitcoincash')){
                /** @var Money $moneyBitcoincash */
                $moneyBitcoincash = Castable::cast(new Money(), $json->pricing->bitcoincash);
                $pricing->setBitcoincash($moneyBitcoincash);
            }
            //litecoin
            if(property_exists($pricing, 'litecoin')){
                /** @var Money $moneyLitecoin */
                $moneyLitecoin = Castable::cast(new Money(), $json->pricing->litecoin);
                $pricing->setLitecoin($moneyLitecoin);
            }
            $charge->setPricing($pricing);
        }



        /**
         * 5-)
         * Payment array
         * @var Payment[] $paymentsArr
         */
        $paymentsArr = array();
        foreach ($json->payments as $item){
            /** @var Payment $payment */
            $payment = Castable::cast(new Payment(), $item);

            //if value property exists in item (payment) json object
            if(property_exists($item, 'value')){
                /** @var Value $value */
                $value = Castable::cast(new Value(), $item->value);
                //local money
                if(property_exists($item->value, 'local')){
                    /** @var Money $moneyLocal */
                    $moneyLocal = Castable::cast(new Money(), $item->value->local);
                    $value->setLocal($moneyLocal);
                }
                //crypto money
                if(property_exists($item->value, 'crypto')){
                    /** @var Money $moneyCrypto */
                    $moneyCrypto= Castable::cast(new Money(), $item->value->crypto);
                    $value->setCrypto($moneyCrypto);
                }
                $payment->setValue($value);
            }

            //if block property exists in item (payment) json object
            if(property_exists($item, 'block')){
                /** @var Block $block */
                $block = Castable::cast(new Block(), $item->block);
                $payment->setBlock($block);
            }

            $paymentsArr[] = $payment;
        }
        $charge->setPayments($paymentsArr);

        /**
         * 6-)
         * Metadata object
         * @var Metadata $metadata
         */
        $metadata = Castable::cast(new Metadata(), $json->metadata);
        $charge->setMetadata($metadata);

        return $charge;
    }


    /**
     * @param $jsonString
     * @return Charges
     */
    public function parseCharges($jsonString): Charges {

        $json = json_decode($jsonString);

        //do nothing if nil
        if(is_null($json)) return null;

        /**
         * Create the Charges object
         * @var Charges $charges
         */
        $charges = Castable::cast(new Charges(), $json);

        /** @var Pagination $pagination */
        $pagination = Castable::cast(new Pagination(), $json->pagination);
        $charges->setPagination($pagination);

        /** @var Charge[] $chargeArr */
        $chargeArr = array();
        foreach ($json->data as $item){
            //echo " " .$item->code;
            /** @var Charge $charge */
            $charge = $this->parseCharge(json_encode($item));
            $chargeArr[] = $charge;
        }
        $charges->setData($chargeArr);


        return $charges;
    }

    /**
     * @param $code
     * @return Charge|null
     */
    public function showCharge($code){

        if(is_null($code) || empty($code)) return null;

        $jsonString = $this->getCommerceClient()->getCharge($code);
        $charge = $this->parseCharge($jsonString);
        return $charge;
    }

    /**
     * @return Charges
     */
    public function listCharges(){

        $jsonString = $this->getCommerceClient()->getCharges();
        $charges = $this->parseCharges($jsonString);
        return $charges;

    }

    /**
     * Validate webhook signature
     *
     * @param string $cc_signature, string $secret, JSON $request
     * @return boolean
     */
    public function validateWebhookSignature($cc_signature, $request) {
        if ($cc_signature != hash_hmac('SHA256', $request , $this->getCommerceClient()->getWebhooksecret())){
            return false;
        }
        return true;
    }

    /**
     * @return CommerceClient
     */
    public function getCommerceClient(): CommerceClient
    {
        return $this->commerceClient;
    }

    /**
     * @param CommerceClient $commerceClient
     */
    public function setCommerceClient(CommerceClient $commerceClient): void
    {
        $this->commerceClient = $commerceClient;
    }
}