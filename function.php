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

# if a GET variable is set then process the token upgrade
if (isset($_GET['token'])) {
    updateAuthSubToken($_GET['token']);
}

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
 * Upgrade the single-use token to a session token.
 *
 * @param string $singleUseToken A valid single use token that is upgradable to a session token.
 * @return void
 */
function updateAuthSubToken($singleUseToken)
{
    try {
        $sessionToken = Zend_Gdata_AuthSub::getAuthSubSessionToken($singleUseToken);
    } catch (Zend_Gdata_App_Exception $e) {
        print 'ERROR - Token upgrade for ' . $singleUseToken
            . ' failed : ' . $e->getMessage();
        return;
    }

    $_SESSION['sessionToken'] = $sessionToken;
    header('Location: ' . HOME_URL);
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