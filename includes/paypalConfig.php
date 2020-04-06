<?php

require_once("PayPal-Php-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'ENTER YOUR PAYPAL ID FOR BILLING TO WORK',     // ClientID
        'ENTER YOUR PAYPAL SECRET FOR BILLING TO WORK'      // ClientSecret
    )
);

?>