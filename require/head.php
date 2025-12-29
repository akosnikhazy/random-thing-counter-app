<?php
/***********************
	Nikházy Ákos

head.php - To autolad classes, form classes folder
***********************/

// views check if this is set, so on badly setup servers
// they can not be run on their own.
define('INIT',true);
define('APPKEY','7a159d53e581bd7883e1af3d29e305fcb0a849ab3fae1ecd85edec05ec478a74');

spl_autoload_register(function ($class) {
    $file = 'classes/' . $class . '.class.php';
    if (file_exists($file)) {
        require_once ($file);
    }
});

spl_autoload_register(function ($class) {
    $file = 'controller/' . $class . '.php';
    if (file_exists($file)) {
        require_once ($file);
    }
});
header("X-Frame-Options: DENY");
