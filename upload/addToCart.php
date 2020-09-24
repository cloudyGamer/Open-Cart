<?php
require_once DIR_STORAGE."vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
//get posted form data
$APIproduct_id = $_POST["product_id"];
$APIquantity = $_POST["quantity"];

$pp_order = new Logger('addToCart.php');
// Now add some handlers
$pp_order->pushHandler(new StreamHandler('/home/customer/www/pauldowlingportfolio.com/{file path}', Logger::DEBUG));
$pp_order->pushHandler(new FirePHPHandler());
$pp_order->info('addToCart.php called');

$pp_order->info('productid='.$APIproduct_id);

$url = $_POST["url"]; 

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
'product_id'=> $APIproduct_id,
'quantity'=> $APIquantity,  
);

$response = do_curl_request($url, $fields);
/*original*/      
$response = json_encode($response);
echo $response;
/*original*/

?>
