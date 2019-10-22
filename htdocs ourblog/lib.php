<?php 
	function auto($f){
		require "$f.php";
	}
	spl_autoload_register("auto");

	function alert($t){
		echo "<script>alert('$t');</script>";
	}
	function back($t = ''){
		if(!empty($t))
			alert($t);
		echo "<script>history.back();</script>";
		exit;
	}
	function move($l,$t = ''){
		if(!empty($t))
			alert($t);
		echo "<script>location.replace('$l')</script>";
		exit;
	}
	function view($f,$d){
		extract($d);
		require "src/View/temp/header.php";
		if($f == 'main'){
			require "src/View/main.php";
		}else{
			$f = explode("/",$f);
			require "src/View/$f[0]/$f[1].php";
		}
		require "src/View/temp/footer.php";
	}
	function ss(){
		return isset($_SESSION['user'])? $_SESSION['user'] : false;
	}