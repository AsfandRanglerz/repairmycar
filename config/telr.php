<?php return array (
  'test_mode' => '1',
  'currency' => 'AED',
  'sale' => 
  array (
    'endpoint' => 'https://secure.telr.com/gateway/order.json',
  ),
  'create' => 
  array (
    'ivp_method' => 'create',
    'ivp_store' => '27475',
    'ivp_authkey' => 'xZQM#RzKRr^CR9qK',
    'return_auth' => '/user/order-payment/success',
    'return_can' => '/user/order-payment/cancel',
    'return_decl' => '/user/order-payment/declined',
  ),
);