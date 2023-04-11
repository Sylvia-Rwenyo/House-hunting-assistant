<?php
$consumer_key = '28fcTuWKy4Z221luDhjuTbqO9788EP1l';
$consumer_secret = '';
$Business_code = '';
$Passkey = 'YBAl7s18sKevXSvl';
$Token_URL = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$CallBackURL = '';
$Type_of_Transaction = 'CustomerPayBillOnline';
$phone_number = $_POST['phonenumber'];
$OnlinePayment = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$total_amount = $_POST['amount'];
$Time_Stamp = date("Ymdhis");
$password = base64_encode($Business_code . $Passkey. $Time_Stamp);

//generate authenitcation token
$curl_transfer = curl_init();
curl_setopt($curl_transfer, CURLOPT_URL, $Token_URL);
$credentials = base64_encode($consumer_key. ':'.$consumer_secret);
curl_setopt($curl_transfer, CURLOPT_HTTPHEADER, array('Authorization: Basic'. $credentials));
curl_setopt($curl_transfer, CURLOPT_HEADER, false);
curl_setopt($curl_transfer, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_transfer, CURLOPT_SSL_VERIFYPEER, false);
$curl_transfer_response = curl_exec($curl_transfer);

$token = json_decode($curl_transfer_response)->access_token;

$curl_transfer2 = curl_init();
curl_setopt($curl_transfer2, CURLOPT_URL, $OnlinePayment);
curl_setopt($curl_transfer2, CURLOPT_HTTPHEADER,array('Content-Type: application.json', 'Authorization:Bearer'.$token));

$curl_transfer2_post_data = [
    'BusinessShortCode' => $Business_code,
    'Password' => $password,
    'Timestamp' => $Time_Stamp,
    'TransactionType' => $Type_of_Transaction,
    'Amount' => $total_amount,
    'PartyA' => $phone_number,
    'PartyB' => $Business_code,
    'phoneNumber' => $phone_number,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => 'Konstra',
    'TransactionDesc' => 'Test',
];

$data2_string = json_encode($curl_transfer2_post_data);

curl_setopt($curl_transfer2, CURLOPT_HEADER, false);
curl_setopt($curl_transfer2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_transfer2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_transfer2, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl_transfer2, CURLOPT_POST, true);
curl_setopt($curl_transfer2, CURLOPT_POSTFIELDS, $data2_string);

$curl_transfer2_response = json_decode(curl_exec($curl_transfer2));

echo json_encode($curl_transfer2_response, JSON_PRETTY_PRINT)
?>