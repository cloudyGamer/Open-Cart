<?php
//get posted form data
$url = "http://www.testonly.forevermecosmetics.ie/upload/index.php?route=api/shipping/dump&api_token=".$newAPIToken; 
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
//'api_token'=> '4adecfb2d129b58e10d010ad67',
'firstname'=> 'Paul',
'lastname'=> 'downg',  
'address_1'=> 'billy street',
'address_2' => 'Billy road',
'postcode' => 'D8',
'city'=> 'Dublin',
'country_id' => '222',
'zone_id' => '3514'
);

$response = do_curl_request($url, $fields);
/*original*/      
var_dump($response);

/*original*/

?>
