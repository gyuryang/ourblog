<?php 
	session_start();
	date_default_timezone_set('Asia/Seoul');

	require "lib.php";
	require "web.php";

	src\Core\Route::init();