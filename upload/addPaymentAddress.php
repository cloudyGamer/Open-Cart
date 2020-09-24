<?php

//get posted form data
$APIfirstname = $_POST["firstnameBill1"];
$APIlastname = $_POST["lastnameBill1"];
$APIpostcode = $_POST["postcodeBill1"];
$APIaddress_1 = $_POST["address_1Bill1"];
$APIaddress_2 = $_POST["address_2Bill1"];
$APIcompany = $_POST["companyBill1"];
$APIcity = $_POST["cityBill1"];
$APIpostcode = $_POST["postcodeBill1"];
$url = $_POST["url"]; 

//working code//

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
    'company' => $APIcompany,
    'address_1'=> $APIaddress_2,
    'address_2' => $APIaddress_1,
    'company' => $APIcompany,
    'postcode' => $APIpostcode,
    'city'=> $APIcity,
    'country_id' => '222',
    'zone_id' => '3514'
);

$response = do_curl_request($url, $fields);
/*original*/      
var_dump($response);
/*original*/

?>
