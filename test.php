<?php
session_start();

$ch = curl_init();

// curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:test_c20e85ee28a9250faf03516f0d3",
                  "X-Auth-Token:test_6f04d648486f3628c03118a3d6f"));
$payload = Array(
    'purpose' => 'Buy Product',
    'amount' => '10',
    'phone' => '9999999999',
    'buyer_name' => 'Usama Husain',
    'redirect_url' => 'http://localhost/thedecorshop/redirect.php',
    'send_email' => true,
    // 'webhook' => 'http://www.example.com/webhook/',
    'send_sms' => true,
    'email' => 'nhusain34@gmail.com',
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
$response = json_decode($response);
// echo '<pre>';
// print_r($response);
$_SESSION['TID'] = $response->payment_request->id;
header('location:'.$response->payment_request->longurl);
die();
?>