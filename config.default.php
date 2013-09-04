<?php
    # Generate operation URL
    $operationUrl = 'http://'. $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

    # Generate home URL
    $path = explode('/', $_SERVER['PHP_SELF']);
    $path[count($path)-1] = 'index.php';
    $homeUrl = 'http://'. $_SERVER['HTTP_HOST'] . implode('/', $path);

    define('GDATA_SCOPE', 'https://gdata.youtube.com');
    define('HOME_URL', $homeUrl);
    define('OPERATIONS_URL', $operationUrl);

    # Insert your credential here
    define('DEV_KEY', '[Google Developers Key]');
    define('CLIENT_ID', '[Google App Client ID]');
    define('CLIENT_SECRET', '[Google App Client Secret]');
