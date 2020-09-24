<?php
require_once  "/home/customer/www/pauldowlingportfolio.com/public_html/opencart-3.0.3.1/upload/system/storage/vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$curlRequest = new Logger('getCatagory.php');
  // Now add some handlers
$curlRequest->pushHandler(new StreamHandler('/home/customer/www/pauldowlingportfolio.com/{file path}', Logger::DEBUG));
$curlRequest->pushHandler(new FirePHPHandler());
//CORS Request handling
if($_SERVER['REQUEST_METHOD'] == "GET") {

  $curlRequest->info('response= GET condition met');
  header('Content-Type: text/plain');

} elseif($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
  $curlRequest->info('response= OPTIONS condition met');

} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
  $curlRequest->info('response= POST conditions met');
  $obj = json_decode($_POST['objStr']);
  $curlRequest->info('posted content'.json_encode($obj));
  $url = $obj->url;
  $searchQueries = $obj->searchQuery;
  $searchQueries = (array) $searchQueries;
 // ///////////////////// recreate query concantenation process in curl request to view URL. appearance
function example_request($url, $examples=array()) {
    $example_string = '';
    foreach($examples as $key=>$value) {
    $example_string .= $key.'='.$value.'&';
    }
    rtrim($example_string, '&'); 
    return $url.$example_string;
}   
//call function
//////////////////////
  function do_curl_request($url, $params=array()) {

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/apicookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/apicookie.txt');

    $params_string = '';
    if (is_array($params) && count($params)) {
    //$curlRequest->info('is array now'.__Line__);


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

$newVar = do_curl_request($url,$searchQueries);

$newVar =  json_encode($newVar);
echo $newVar;
   }
else{
    die("No Other Methods Allowed");
}



?>
