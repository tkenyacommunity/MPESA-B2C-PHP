
<?php

/* APPLY TO MPESA VIA EMAIL TO ENABLE YOUR TILL TO HAVE B2C. GO LIVE IN DARAJA. FOR MORE CALL +254115427576  www.tkenya.co.ke  */
/* GO LIVE IN DARAJA. FOR MORE CALL +254115427576  www.tkenya.co.ke  */
/* GET HELP TO HOST YOUR TILLS AT 7500 KSH OR  +254115427576  www.tkenya.co.ke  */
$access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$b2c_url = 'https://api.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';


/* Required Variables */
$consumerKey = 'EewrtfyghujkhgKy9Xib9qOw';        # Fill with your app Consumer Key
$consumerSecret = '9wertyghuv0c';     # Fill with your app Secret
$headers = ['Content-Type:application/json; charset=utf8'];

/* from the test credentials provided on you developers account */
$InitiatorName = 'tkenya';      # Initiator mpesa admin account
$SecurityCredential = "rfgthhkghfh";  #get it from daraja account
$CommandID = 'BusinessPayment';          # choose between SalaryPayment, BusinessPayment, PromotionPayment 
$Amount = '1';
$PartyA = '4653';             # shortcode in your daraja account
$PartyB = '2541237456';             # Phone number you're sending money to format 25411...678
$Remarks = 'Salary';      # Remarks ** can not be empty
$QueueTimeOutURL = 'https://.....php';    # your QueueTimeOutURL to receive feedback where to hook up sms 
$ResultURL = 'https://......php';          # your ResultURL . hook sms there too
$Occasion = 'Occasion';           # Occasion

/* Obtain Access Token */
$curl = curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result);
$access_token = $result->access_token;
curl_close($curl);

/* Main B2C Request to the API */
$b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $b2c_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header

$curl_post_data = array(
  //Fill in the request parameters with valid values
  'InitiatorName' => $InitiatorName,
  'SecurityCredential' => $SecurityCredential,
  'CommandID' => $CommandID,
  'Amount' => $Amount,
  'PartyA' => $PartyA,
  'PartyB' => $PartyB,
  'Remarks' => $Remarks,
  'QueueTimeOutURL' => $QueueTimeOutURL,
  'ResultURL' => $ResultURL,
  'Occasion' => $Occasion
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
print_r($curl_response);
echo $curl_response;
?>
