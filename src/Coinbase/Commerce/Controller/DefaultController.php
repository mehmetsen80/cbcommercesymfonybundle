<?php
/**
 * Created by PhpStorm.
 * User: msen
 * Date: 7/1/18
 * Time: 2:49 PM
 */

namespace App\Coinbase\Commerce\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(){
        return $this->render('CoinbaseCommerceBundle:Default:index');
    }
}