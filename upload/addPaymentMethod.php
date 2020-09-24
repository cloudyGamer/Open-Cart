<?php
$APIlastname = $_POST["lastname"];
$APIemail = $_POST["email"];
$APItelephone = $_POST["telephone"];  
$url = $_POST["url"];
$payment_method =  $_POST["payment_method"];
//working code //
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
'payment_method'=> $payment_method
);

$response = do_curl_request($url, $fields);
//original //    
var_dump($response);
//original//

?>
