<?php
session_start();

# Run ZGDATA Autoloader
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');

# Generate operation URL
$operationUrl = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

# Generate home URL
$path = explode('/', $_SERVER['PHP_SELF']);
$path[count($path)-1] = 'index.php';
$homeUrl = 'http://'. $_SERVER['HTTP_HOST'] . implode('/', $path);

define('GDATA_SCOPE', 'https://gdata.youtube.com');
define('HOME_URL', $homeUrl);
define('OPERATIONS_URL', $operationUrl);
define('DEV_KEY', 'AIzaSyDnuYpp69lokct6Sq_tU7e9QFg60Apt_uY');
define('CLIENT_ID', '188059253473.apps.googleusercontent.com');
define('CLIENT_SECRET', 'i8Dmah6dbY7zjJlLFUalG6RW');

# Generate sub token URL
function generateSubTokenUrl($nextUrl = null)
{
    $secure = false;
    $session = true;

    if (!$nextUrl) {
        $nextUrl = OPERATIONS_URL;
    }

    $url = Zend_Gdata_AuthSub::getAuthSubTokenUri($nextUrl, GDATA_SCOPE, $secure, $session);
    
    return $url;
}

/**
 * Helper function to check whether a session token has been set
 *
 * @return boolean Returns true if a session token has been set
 */
function authenticated()
{
    if (isset($_SESSION['sessionToken'])) {
        return true;
    }
}