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
            <h2>Contoh penggunaan API Youtube dengan PHP</h2>
        </div>
        <?php if (!authenticated()) : ?>
            <p>
                Anda belum terhubung dengan Youtube silahkan <a href="<?php echo generateSubTokenUrl(); ?>">Klik disini</a>
                untuk menghubungkan aplikasi ini dengan account Youtube anda
            </p>
        <?php else : ?>
            <p>
                Anda sudah terhubung, dan token anda adalah :
                <pre><?php echo $_SESSION['sessionToken']; ?></pre>                
            </p>

            <hr>

            <h1>Contoh penggunaan token</h1>

            <h3>User Profile</h3>

            <p>
                Target Url : <code>https://gdata.youtube.com/feeds/api/users/default</code>
            </p>

            <p>
                Pada saat melakukan <code>GET</code> request ke url tersebut anda harus menyertakan token yang anda dapat pada saat menghubungkan aplikasi, contoh kode :

                <pre>
                    $httpClient = Zend_Gdata_AuthSub::getHttpClient(TOKEN_SESSION);

                    // lihat di https://developers.google.com/gdata/docs/developers-guide atau
                    // http://stackoverflow.com/questions/10704299/zend-gdata-calendar-api-returns-version-3-0-is-not-supported
                    $httpClient->setHeaders('GData-Version', '2.0');

                    $youtube = new Zend_Gdata_YouTube($httpClient, APPLICATION_ID, CLIENT_ID, DEVELOPER_KEY);

                    // Variabel $profile akan menyimpan semua informasi profile dari user yang terhubung
                    // dalam bentuk object class Zend_Gdata_YouTube_UserProfileEntry
                    $profile = $youtube->getUserProfile();
                </pre>

                Hasil yang didapat :

                <pre>
<?php
                    $httpClient = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
                    $httpClient->setHeaders('GData-Version', '2.0');
                    $youtube = new Zend_Gdata_YouTube($httpClient, APP_ID, CLIENT_ID, DEV_KEY);

                    // Variabel $profile akan menyimpan semua informasi profile dari user yang terhubung
                    $profile = $youtube->getUserProfile('default');

                    echo '// $profile->getUsername();<br/>';
                    echo $profile->getUsername();

                    echo '<br/><br/>';
                    echo '// $profile->getFirstName();<br/>';
                    echo $profile->getFirstName();

                    echo '<br/><br/>';
                    echo '// $profile->getLastName();<br/>';
                    echo $profile->getLastName();
                    ?>
                </pre>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>