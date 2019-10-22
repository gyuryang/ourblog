<?php 
	use src\Core\Route;

	Route::reg([
		["get","/@MainController@main"],
		["get","/main/:page@MainController@main"],
		["get","/main/:page/:life@MainController@main"],
		["get","/authors/:page/:uidx@MainController@main"],
		["get","/view/:aidx@BoardController@view"],
		["post","/view/search/:page/:variable@MainController@main"],
	]);
	if(ss()){
		Route::reg([
			["get","/user/logout@UserController@logout"],
			["get","/board/write@BoardController@write"],
			["get","/board/modify/:aidx@BoardController@modify"],
			["post","/board/write_action@BoardController@write_action"],
			["post","/board/coment_create@BoardController@coment_create"],
			["post","/board/del@BoardController@del"],
			["post","/board/modify_action@BoardController@modify_action"],
		]);
	}else{
		Route::reg([
			["get","/user/join@UserController@join"],
			["post","/user/join_action@UserController@join_action"],
			["post","/user/login_action@UserController@login_action"],
		]);
	}

