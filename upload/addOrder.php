<?php
require_once DIR_STORAGE."vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

$curlRequest = new Logger('addOrder_pp_info_response.php');
	// Now add some handlers
$curlRequest->pushHandler(new StreamHandler('/home/customer/www/pauldowlingportfolio.com/{file path}', Logger::DEBUG));
$curlRequest->pushHandler(new FirePHPHandler());
//CORS Request handling
if($_SERVER['REQUEST_METHOD'] == "GET") {

    $curlRequest->info('response= GET condition met');

    header('Content-Type: text/plain');
    echo json_encode("This HTTP resource is designed to handle POSTed XML input");


} elseif($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
    $curlRequest->info('response= OPTIONS condition met');
 
    echo json_encode("options taken");
  

} elseif($_SERVER['REQUEST_METHOD'] == "POST") {
    $url = $_POST["url"];
    //echo "the url should be...".$url;
    // Handle POST by first getting the XML POST blob, 
    // and then doing something to it, and then sending results to the client
    //my curl request goes here
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

    $fields = array();

    $newVar = do_curl_request($url);
    $curlRequest->info('this is the response from pp_order:'.$newVar.__Line__);
    $newVar = json_encode($newVar);
    echo $newVar;

    $curlRequest->info("this is the encode response from pp_order:".$newVar);

   
  }
else{
    die("No Other Methods Allowed");
}

?>
