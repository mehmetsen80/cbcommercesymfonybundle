# Coinbase Commerce Symfony Bundle

A Symfony bundle for Coinbase Commerce Api 

## API Reference

For more information about Coinbase Commerce API, look at:
 
> https://commerce.coinbase.com/docs/

## Getting Started

Assuming you already have your own **symfony 4** project, please follow the below instructions along with configuration installation and test codes.
This bundle makes it very easy to develop high level of Coinbase Commerce applications. 

## Prerequisites

Create **_coinbase.yaml_** file under folder **_[symfonyproject]/config/packages/_**  

##### coinbase.yaml

```
coinbase_commerce:
  api:
    key: 3f8944d4*********************
    version: "2018-03-22"
  webhook:
    secret: 3e859e4b************************
```



## Installing

Download the bundle with your composer

```
composer require msen/coinbase-commerce-symfony-bundle
```

## Configure Service

Let's check out the services

```
php bin/console debug:container
```


After you have installed the bundle, syfmony will have the following service
> _coinbase.commerce.client    App\Coinbase\Commerce\Handler\CoinbaseHandler_ 


However, the _**coinbase.commerce.client**_ is still private, so let's create the public alias

Add public alias on **_[symfonyproject]/config/services.yaml_** 
```
coinbase.commerce:
    alias: 'coinbase.commerce.client'
    public: true
```

## Development

You can get the handler inside your Controller and call the functions

## Example
### Get the Charge Handler
Since we made the public alias, we can get it anywhere we want
```
/**
* get the coinbase handler
* @var CoinbaseHandler $coinbaseHandler
*/
$coinbaseHandler = $this->container->get('coinbase.commerce');
```


### Create new Charge
Let's create a new charge along with $3.6 donation. The input can be json array, json string or Charge object

#### CALL WITH JSON ARRAY
```
   /**
    * @Route("/acceptcrypto/", name="acceptcrypto")
    */
    public function acceptDonation(){
        $amount = 3.6;//$3.6 dollars
        $json =  [
           "name" => "Cancer Donation Box",
           "description" => "Donate to Children",
           "local_price" => array("amount" => $amount, "currency" => "USD"),
           "pricing_type" => "fixed_price",
           "metadata" => array("id" => "1234", "firstname" => "John", "lastname" => "Doe", "email" => "jdoe@example.com")
        ];
        
        /**
        * @var CoinbaseHandler $coinbaseHandler
        */
        $coinbaseHandler = $this->container->get('coinbase.commerce');
        
        /**
        * @var Charge $charge
        */
        $charge = $coinbaseHandler->createNewCharge($json);//get the charge object

        $this->redirect($charge->getHostedUrl());//it will redirect you to the coinbase crypto box to be paid in 15 minutes
    }
```

#### CALL WITH JSON STRING
```
   /**
    * @Route("/acceptcrypto/", name="acceptcrypto")
    */
    public function acceptDonation(){
        
        $json_string = "{\"name\":\"Cancer Donation Form\",\"description\":\"Donation to Children\",\"pricing_type\":\"fixed_price\",\"local_price\":{\"amount\":\"2.7\",\"currency\":\"USD\"},\"meta_data\":{\"id\":\"12345\",\"firstname\":\"Victor\",\"lastname\":\"Doe\",\"email\":\"vdoe@example.com\"}}";
        
        /**
        * @var CoinbaseHandler $coinbaseHandler
        */
        $coinbaseHandler = $this->container->get('coinbase.commerce');
        
        /**
        * @var Charge $charge
        */
        $charge = $coinbaseHandler->createNewCharge($json_string);//get the charge object

        $this->redirect($charge->getHostedUrl());//it will redirect you to the coinbase crypto box to be paid in 15 minutes
    }
```

#### CALL WITH CHARGE OBJECT
```
   /**
    * @Route("/acceptcrypto/", name="acceptcrypto")
    */
    public function acceptDonation(){
        
        /**
        * @var Charge $charge
        */
        $charge = new Charge();
        $charge->setName("Cancer Donation Form");
        $charge->setDescription("Donation to Children");
        $charge->setPricingType("fixed_price");
       
        $localPrice = new Money();
        $localPrice->setAmount(2.6);
        $localPrice->setCurrency("USD");
        $charge->setLocalPrice($localPrice);
       
       
        //Whatever object fields you wanna put
        $metadata = new Metadata();
        $metadata->id = "1234";
        $metadata->firstname = "Melisa";
        $metadata->lastname = "Doe";
        $metadata->email = "mdoe@example.com";
        $charge->setMetadata($metadata);
       
        /**
        * @var CoinbaseHandler $coinbaseHandler
        */
        $coinbaseHandler = $this->container->get('coinbase.commerce');
        
        /**
        * @var Charge $charge
        */
        $charge = $coinbaseHandler->createNewCharge($charge);//get the charge object

        $this->redirect($charge->getHostedUrl());//it will redirect you to the coinbase crypto box to be paid in 15 minutes
    }
```

## Show a Charge
```
$code = "2G3GM4X9";
/**
* get a single charge
* @var Charge $charge
*/
$charge = $coinbaseHandler->showCharge($code);
$hosted_url = $charge->getHostedUrl();
```

## List Charges
```
/**
* list charges
* @var Charges $charges
*/
$charges = $this->_coinbaseHandler->listCharges();

//iterate through the charges
foreach ($charges->getData() as $charge){
    print_r($charge);
}
```

## Charge Object

Charge is one of your main object model that is re-usable once it is retrieved. It includes all other object models;
> Addresses, Timeline, Pricing, Money etc..

It includes the raw json string as well in case you need to look up the fields manually. 
```
$charge->getRawJson()
```

Here is an example of a returned Charge object that is already expired. No action taken in 15 minutes

```
App\Coinbase\Commerce\Model\Charge Object
(
    [code:protected] => GR9M6MYK
    [name:protected] => Cancer Donation Box
    [description:protected] => Donate to Children
    [hosted_url:protected] => https://commerce.coinbase.com/charges/GR9M6MYK
    [created_at:protected] => 2018-06-18T22:21:38Z
    [expires_at:protected] => 2018-06-18T22:36:38Z
    [confirmed_at:protected] => 
    [pricing_type:protected] => fixed_price
    [addresses:protected] => App\Coinbase\Commerce\Model\Addresses Object
        (
            [ethereum:protected] => 0xa5027c04f257f8f9c4a2f1f10***************
            [bitcoin:protected] => 1PTGB2jGD8ohqdtPPFa***************
            [bitcoincash:protected] => qqz8q26722wq22ep9fsxy0vu4sz***************
            [litecoin:protected] => LKF2ETmPtqkqYG1s1f1***************
        )

    [metadata:protected] => App\Coinbase\Commerce\Model\Metadata Object
        (
            [id] => 1234
            [firstname] => John
            [lastname] => Doe
            [email] => jdoe@example.com
        )

    [timeline:protected] => Array
        (
            [0] => App\Coinbase\Commerce\Model\Timeline Object
                (
                    [status:protected] => NEW
                    [time:protected] => 2018-06-18T22:21:38Z
                    [payment:protected] => 
                )

            [1] => App\Coinbase\Commerce\Model\Timeline Object
                (
                    [status:protected] => EXPIRED
                    [time:protected] => 2018-06-18T22:36:46Z
                    [payment:protected] => 
                )

        )

    [pricing:protected] => App\Coinbase\Commerce\Model\Pricing Object
        (
            [local:protected] => App\Coinbase\Commerce\Model\Money Object
                (
                    [amount:protected] => 1.00
                    [currency:protected] => USD
                )

            [ethereum:protected] => App\Coinbase\Commerce\Model\Money Object
                (
                    [amount:protected] => 0.001935000
                    [currency:protected] => ETH
                )

            [bitcoin:protected] => App\Coinbase\Commerce\Model\Money Object
                (
                    [amount:protected] => 0.00014900
                    [currency:protected] => BTC
                )

            [bitcoincash:protected] => App\Coinbase\Commerce\Model\Money Object
                (
                    [amount:protected] => 0.00112791
                    [currency:protected] => BCH
                )

            [litecoin:protected] => App\Coinbase\Commerce\Model\Money Object
                (
                    [amount:protected] => 0.01010867
                    [currency:protected] => LTC
                )

        )

    [payments:protected] => Array
        (
        )

    [json:protected] => Array
        (
            [data] => Array
                (
                    [addresses] => Array
                        (
                            [ethereum] => 0xa5027c04f257f8f9c4a2f1f10***************
                            [bitcoin] => 1PTGB2jGD8ohqdtPPFa***************
                            [bitcoincash] => qqz8q26722wq22ep9fsxy0vu4sz***************
                            [litecoin] => LKF2ETmPtqkqYG1s1f1***************
                        )

                    [code] => GR9M6MYK
                    [created_at] => 2018-06-18T22:21:38Z
                    [description] => Donate to Children
                    [expires_at] => 2018-06-18T22:36:38Z
                    [hosted_url] => https://commerce.coinbase.com/charges/GR9M6MYK
                    [metadata] => Array
                        (
                            [id] => 1234
                            [firstname] => John
                            [lastname] => Doe
                            [email] => jdoe@example.com
                        )

                    [name] => Cancer Donation Box
                    [payments] => Array
                        (
                        )

                    [pricing] => Array
                        (
                            [local] => Array
                                (
                                    [amount] => 1.00
                                    [currency] => USD
                                )

                            [ethereum] => Array
                                (
                                    [amount] => 0.001935000
                                    [currency] => ETH
                                )

                            [bitcoin] => Array
                                (
                                    [amount] => 0.00014900
                                    [currency] => BTC
                                )

                            [bitcoincash] => Array
                                (
                                    [amount] => 0.00112791
                                    [currency] => BCH
                                )

                            [litecoin] => Array
                                (
                                    [amount] => 0.01010867
                                    [currency] => LTC
                                )

                        )

                    [pricing_type] => fixed_price
                    [timeline] => Array
                        (
                            [0] => Array
                                (
                                    [status] => NEW
                                    [time] => 2018-06-18T22:21:38Z
                                )

                            [1] => Array
                                (
                                    [status] => EXPIRED
                                    [time] => 2018-06-18T22:36:46Z
                                )

                        )

                )

        )

)

```


## Unit Test

Let's Create a unit test file that extends KernelTestCase

```
<?php

namespace App\Tests\Controller;


use App\Coinbase\Commerce\Handler\CoinbaseHandler;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

class TestCoinbaseCommerceSymfonySDK extends KernelTestCase
{
    /**
     * @var Container
     */
    protected $_container;

    /**
     * @var EntityManager
     */
    protected $_entityManager;

    /**
     * @var CoinbaseHandler
     */
    protected $_coinbaseHandler;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        try {
            $kernel = self::bootKernel();
            $this->_container = $kernel->getContainer();

            /** @var EntityManager entityManager */
            $this->_entityManager = $this->_container
                ->get("doctrine")->getManager();

            /**
             * @var CoinbaseHandler
             */
            try {
                $this->_coinbaseHandler = $this->_container->get('coinbase.commerce');
            } catch (\Exception $e) {
                echo $e->getMessage(), EOL;
            }


        } catch (\Exception $e) {
            echo $e->getMessage(), EOL;
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown(){
        parent::tearDown();
        $this->_entityManager->close();
        $this->_entityManager = null; // avoid memory leaks
    }

    public function ignore_testServices()
    {
        $this->assertNotNull($this->_entityManager, "Entity Manager is null!!!");
        $this->assertNotNull($this->_container, "Container is null!!!");
        $this->assertNotNull($this->_coinbaseHandler, "Coinbase Handler is null!!!");
    }
    
    public function ignore_testCreateNewChargeWithJsonArray(){
    
            $amount = 3.6;//$3.6 dollars
            $json =  [
                "name" => "Cancer Donation Form",
                "description" => "Donation to Children",
                "local_price" => array("amount" => $amount, "currency" => "USD"),
                "pricing_type" => "fixed_price",
                "metadata" => array("id" => "123456", "firstname" => "John", "lastname" => "Doe", "email" => "jdoe@na.edu")
            ];
    
            /**
             * @var Charge $charge
             */
            try {
                $charge = $this->_coinbaseHandler->createNewCharge($json);
            } catch (\Exception $e) {
                echo $e->getMessage(), EOL;
            }
            echo "code: " . $charge->getCode(), EOL;
            echo "name: " . $charge->getName(), EOL;
            $this->assertNotNull($charge);
            $this->assertEquals("Cancer Donation Form", $charge->getName());
    
     }
    
     public function ignore_testCreateNewChargeWithObject(){
    
            /**
             * @var Charge $charge
             */
            $charge = new Charge();
            $charge->setName("Cancer Donation Form");
            $charge->setDescription("Donation to Children");
            $charge->setPricingType("fixed_price");
    
            $localPrice = new Money();
            $localPrice->setAmount(2.6);
            $localPrice->setCurrency("USD");
            $charge->setLocalPrice($localPrice);
    
            //Whatever object fields you wanna put
            $metadata = new Metadata();
            $metadata->id = "1234";
            $metadata->firstname = "Melisa";
            $metadata->lastname = "Doe";
            $metadata->email = "mdoe@example.com";
            $charge->setMetadata($metadata);
    
            /**
             * @var Charge $charge
             */
            try {
                $charge = $this->_coinbaseHandler->createNewCharge($charge);
            } catch (\Exception $e) {
                echo $e->getMessage(), EOL;
            }
            $this->assertNotNull($charge);
            print_r($charge);
        }
    
    public function ignore_testCreateNewChargeWithJsonString(){
        
            $json_string = "{\"name\":\"Cancer Donation Form\",\"description\":\"Donation to Children\",\"pricing_type\":\"fixed_price\",\"local_price\":{\"amount\":\"2.7\",\"currency\":\"USD\"},\"meta_data\":{\"id\":\"12345\",\"firstname\":\"Victor\",\"lastname\":\"Doe\",\"email\":\"vdoe@example.com\"}}";
    
            /**
             * @var Charge $charge
             */
            try {
                $charge = $this->_coinbaseHandler->createNewCharge($json_string);
            } catch (\Exception $e) {
                echo $e->getMessage(), EOL;
            }
            $this->assertNotNull($charge);
            print_r($charge);
    }

}
```

