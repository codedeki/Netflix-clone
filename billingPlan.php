<?php
require_once("includes/paypalConfig.php");
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

// Create a new billing plan
$plan = new Plan();
$plan->setName('Netflix N Chilli monthly subscription')
  ->setDescription('Get UNLIMITED access to all your favorite shows and movies.')
  ->setType('INFINITE');

// Set billing plan definitions
$paymentDefinition = new PaymentDefinition();
$paymentDefinition->setName('Regular Payments')
  ->setType('REGULAR')
  ->setFrequency('Month')
  ->setFrequencyInterval('1')
  ->setAmount(new Currency(array('value' => 9.99, 'currency' => 'USD')));

$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$returnUrl = str_replace("billing.php", "profile.php", $currentUrl);

// Set merchant preferences
$merchantPreferences = new MerchantPreferences();
$merchantPreferences->setReturnUrl($returnUrl . "?success=true")
  ->setCancelUrl($returnUrl . "?success=false")
  ->setAutoBillAmount('yes')
  ->setInitialFailAmountAction('CONTINUE')
  ->setMaxFailAttempts('0')
  ->setSetupFee(new Currency(array('value' => 9.99, 'currency' => 'USD')));

$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);

//create plan
try {
    $createdPlan = $plan->create($apiContext);
  
    try {
      $patch = new Patch();
      $value = new PayPalModel('{"state":"ACTIVE"}');
      $patch->setOp('replace')
        ->setPath('/')
        ->setValue($value);
      $patchRequest = new PatchRequest();
      $patchRequest->addPatch($patch);
      $createdPlan->update($patchRequest, $apiContext);
      $plan = Plan::get($createdPlan->getId(), $apiContext);
  
      // Output plan id
      echo $plan->getId();
    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
  } catch (Exception $ex) {
    die($ex);
  }
?>