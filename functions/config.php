<!-- Php area is referred from https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php -->
<?php
// DB connection
define('HOST', 'localhost');
define('DBUSER', 'egmrdwjs_novatw');
define('DBPASS', 'schumann!104');
define('DBNAME', 'egmrdwjs_demo1');

//Enable connection
try {
    $pdo = new PDO("mysql:host=" . HOST . "; dbname=" . DBNAME, DBUSER, DBPASS);
    //Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Error: Could not connect. " . $e->getMessage());
}
?>