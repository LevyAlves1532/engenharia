<?php

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

class checkoutController extends controller {
  public function index()
  {
    if (empty($_SESSION['user'])) {
      header('Location: ' . BASE . 'carrinho');
    }

    $data = [];

    $data['card'] = [
      'securityCode' => '123',
      'expirationYear' => '11/25',
      'holderName' => 'FULANO DEL GENBRE',
      'identificationNumber' => '58428309060',
      'holderEmail' => 'fulano.genbre@gmail.com',
    ];

    $this->loadTemplate('checkout', $data);
  }

  public function process_payment()
  {
    $payments = new Payments();
    $payment_projects = new PaymentProjects();

    if (empty($_SESSION['user'])) {
      header('Location: ' . BASE . 'carrinho');
    }

    try {
      ini_set('display_errors','Off');
      ini_set('error_reporting', E_ALL );
      error_reporting(0);

      MercadoPagoConfig::setAccessToken(ACCESS_TOKEN_MERCADO_PAGO);
      MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

      $client = new PaymentClient(); 

      $cart = json_decode($_POST['cart']);
      
      $request = [
        "transaction_amount"      => (float) $_POST['transaction_amount'],
        "token"                   => $_POST['token'],
        "description"             => $_POST['description'],
        "installments"            => (int) $_POST['installments'],
        "payment_method_id"       => $_POST['payment_method_id'],
        "issuer_id"               => $_POST['issuer_id'],
        "payer" => [
          "email"                 => $_POST['email'],
          "identification" => [
            "type"                => $_POST['type'],
            "number"              => $_POST['number']
          ]
        ]
      ];
  
      $request_options = new RequestOptions();
      $some_unique_value = uniqid();
      $request_options->setCustomHeaders(['X-Idempotency-Key: ' . $some_unique_value]);
  
      $payment = $client->create($request, $request_options);

      $payment_id = $payments->set($_SESSION['user']['id'], $payment->card->first_six_digits, $payment->card->cardholder->name, $payment->payment_method->id, $_POST['email'], $payment->installments, $payment->transaction_details->installment_amount, $payment->transaction_details->total_paid_amount, $payment->status, json_encode($payment));

      foreach ($cart as $cart_item) {
        $payment_projects->set($payment_id, $cart_item->id, $cart_item->is_discount, $cart_item->price, $cart_item->discount_percent);
      }
  
      echo json_encode([ "status" => $payment->status === 'approved' ? true : false ]);
      exit;
    } catch (MPApiException $e) {
      echo json_encode($e->getApiResponse()->getContent());
      exit;
    }
  }
}
