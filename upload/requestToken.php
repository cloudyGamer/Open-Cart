<?php
require_once DIR_STORAGE."vendor/autoload.php";
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

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
//new prefix = http://localhost:8888/
$url = 'http://www.testonly.forevermecosmetics.ie/upload/index.php?route=api/login';
$fields = array(
    'username' => '{username}',
    'key' => '{key}'
);

$curlRequest = new Logger('requestToken.php');
$curlRequest->pushHandler(new StreamHandler('/home/customer/www/pauldowlingportfolio.com/{file path}', Logger::DEBUG));
$curlRequest->pushHandler(new FirePHPHandler());
/*          working code.       */ 
$newVar = do_curl_request($url, $fields);
/*          working code        */
$newVar = json_encode($newVar);
echo $newVar;

function checkRemoteCon(){
 sleep(20); // wait 20 seconds
}
?>
