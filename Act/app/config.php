<?php

// include_once "config.php" en cada controlador

session_start();

    if (!isset($_SESSION['token'])) {
        # code...
        $_SESSION['token'] = md5(uniqid(mt_rand(),true));
    }

    if (!defined('BASE_PATH')) {
        # code...
        define('BASE_PATH', 'URL de la pagina/');
    }


?>
