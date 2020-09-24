<?php
require_once DIR_STORAGE."vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
//get posted form data
$pp_order = new Logger('APINoBody.php');
// Now add some handlers
$pp_order->pushHandler(new StreamHandler('/var/www/vhosts/84/983453/webspace/httpdocs/testonly.forevermecosmetics.ie/upload/app.log', Logger::DEBUG));
$pp_order->pushHandler(new FirePHPHandler());
$pp_order->info('APINoBody.php called');


  $obj = json_decode($_POST['objStr']);
  $pp_order->info('posted content'.json_encode($obj));

  $url = $obj->url;
   $pp_order->info('posted address content'.json_encode($url)); 	
 
function do_curl_request($url) {

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/apicookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/apicookie.txt');
//execute post
$result = curl_exec($ch);
//close connection
curl_close($ch);
return $result;
}
$newVar = do_curl_request($url);

$newVar =  json_encode($newVar);
echo $newVar;
?>
