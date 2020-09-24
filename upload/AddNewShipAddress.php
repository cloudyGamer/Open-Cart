<?php

//get posted form data
$APIfirstname = $_POST["firstname"];
$APIlastname = $_POST["lastname"];
$APIaddress_1 = $_POST["address_1"];
$APIaddress_2 = $_POST["address_2"]; 
$APIcity =  $_POST["city"]; 
$APIpostcode = $_POST["postcode"];
//$APItoken =  $_POST["api_token"]; *

$url = $_POST["url"]; 
//$tokenString = '&api_token=' + (string)$APItoken;      
//$url = "http://www.testonly.forevermecosmetics.ie/upload/index.php?route=/api/shipping/address&api_token=".$newAPIToken;


/*working code */
function do_curl_request($url, $params=array()) {
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/apicookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/apicookie.txt');

$params_string = '';
if (is_array($params) && count($params)) {
foreach($params as $key=>$value) {
$params_string .= $key.'='.$value.'&';
}
rtrim($params_string, '&'); 

curl_setopt($ch,CURLOPT_POST, count($params));
curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
}

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

return $result;
} 



$fields = array(
'firstname'=> $APIfirstname,
'lastname'=> $APIlastname,  
'address_1'=> $APIaddress_1,
'address_2' => $APIaddress_2,
'postcode' => $APIpostcode,
'city'=> $APIcity,
'country_id' => 'RUS',
'zone_id' => 'KGD'

);

$response = do_curl_request($url, $fields);
var_dump($response);
echo json_encode($APIpostcode);  


?>
