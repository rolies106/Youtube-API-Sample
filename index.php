<?php require_once('function.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>YouTube API sample in PHP</title>
    <link href="video_app.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="main">
        <div id="titleBar">
            <h2>YouTube API sample in PHP</h2>
        </div>
        <?php if (!authenticated()) : ?>
            <p>
                You are not connected, please <a href="<?php echo generateSubTokenUrl(); ?>">Click Here</a>
                to connect to your Youtube account
            </p>
        <?php else : ?>
            <p>
                You are connected with token :
                <pre><?php echo $_SESSION['sessionToken']; ?></pre>                
            </p>

            <p>
                Sample use with current token :

                <pre>
                    Under Construction
                </pre>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>