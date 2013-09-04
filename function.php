<?php
session_start();

# Run ZGDATA Autoloader
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata_YouTube');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_App_Exception');

require_once 'config.php';

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