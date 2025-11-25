<?php 
//Off error parse system | DEBUG mode
// error_reporting(E_ERROR | E_PARSE );
// define('DEBUG', 1);

//Sessions&Cookie life 
ini_set('session.gc_maxlifetime', 172800);
ini_set('session.cookie_lifetime', 172800);

//Main config for JetLine
require_once "paramdb.php";

//Set db config
if ($ectr_host == "") {
    $ectr_connect = null;
}
else {
    $ectr_connect = mysqli_connect($ectr_host, $ectr_login, $ectr_password, $ectr_db);
    $GLOBALS['db'] = $ectr_connect;
        mysqli_set_charset($ectr_connect, $ectr_charset);
        if (!$ectr_connect) {
            die('Error connect to Data base (../global/paramdb.php)!');
        }
}

//Project info
$routes_ectr            = [];
$GLOBALS['404']         = "containers/error_pages/404/404.php";
$GLOBALS['tb_token']    = '';
$GLOBALS['all_trafic']  = 'containers/main';
$GLOBALS['tb_port']     = '/bot';

 ?>
