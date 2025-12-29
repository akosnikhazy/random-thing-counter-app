<?php
/***********************
	Nikházy Ákos

index.php

Loads head with that all settings and decides what to show
to the user based on the presence and value of $_GET['view']
and the login status
***********************/

require_once __DIR__ . '/require/head.php';

$user = new User();

$view = $_GET['view'] ?? 'main';

// if user not logged in the login page is the only place they can go
if(!$user -> getLoginStatus()) $view = 'login';

$router = new Router($view);
$router->route(); 

