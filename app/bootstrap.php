<?php
    // Load Config
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/config/config.php');

    // Load helpers
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/helpers/url_helper.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/helpers/session_helper.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/app/helpers/image_helper.php';

    // Autolaod Core Libraries
    spl_autoload_register(function($className){
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/libraries/' . $className . '.php';
    });

    // EOF