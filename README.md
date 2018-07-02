# Coinbase Commerce Symfony Bundle

A Symfony bundle for Coinbase Commerce Api 

## API Reference

For more information about Coinbase Commerce API, look at:
 
> https://commerce.coinbase.com/docs/

## Getting Started

Assuming you already have your own **symfony 4** project, please follow the below instructions along with configuration installation and test codes.
This bundle makes it very easy to develop high level of Coinbase Commerce applications. 

####Prerequisites

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



#### Installing

Download the bundle with your composer

```
composer require msen/coinbase-commerce-symfony-bundle
```

#### Configure Service

Let's check out the services

```
php bin/console debug:container
```


After you have installed the bundle, syfmony will have the following service
> _coinbase.commerce.client    App\Coinbase\Commerce\Handler\CoinbaseHandler_ 


However, the _**coinbase.commerce.client**_ is still private, so let's create the public alias

Add public alias service
```
coinbase.commerce:
    alias: 'coinbase.commerce.client'
    public: true
```

## Development

You can get the handler inside your Controller and call the functions

### Example

```
   /**
    * @Route("/acceptcrypto/", name="acceptcrypto")
    */
    public function acceptDonation(){
        try{
            /**
             * @var CoinbaseHandler $coinbaseHandler
             */
            $coinbaseHandler = $this->container->get('coinbase.commerce');
            $json = $coinbaseHandler->getCommerceClient()->getCharge("7A3QGBZ6");


        }catch (\Exception $e){
        }

        return $this->render('coinbase/accept.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..')
        ]);
    }
```



### Unit Test

We are ready now to unit test 

Create a unit test file that extends KernelTestCase

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
    
    public function ignore_testCreateNewCharge(){
    
            $amount = 3.6;//$3.6 dollars
            $json =  [
                "name" => "Developer Donation Form",
                "description" => "Donate to Mehmet Sen",
                "local_price" => array("amount" => $amount, "currency" => "USD"),
                "pricing_type" => "fixed_price",
                "metadata" => array("id" => "1234", "firstname" => "Mehmet", "lastname" => "Sen", "email" => "msen@na.edu")
            ];
            $charge = $this->_coinbaseHandler->createNewCharge($json);
            print_r($charge);
            echo "code: " . $charge->getCode(), EOL;
            echo "name: " . $charge->getName(), EOL;
            $this->assertNotNull($charge);
            $this->assertEquals("Developer Donation Form", $charge->getName());
    }

    public function ignore_testGetCharge(){
        $code = "7A3QGBZ6";//completed (ETH)
        $jsonString = $this->_coinbaseHandler->getCommerceClient()->getCharge($code);
        echo $jsonString, EOL;
        $this->assertJson($jsonString, "String is not json");
    }
}
```

