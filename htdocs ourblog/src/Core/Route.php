<?php 
	namespace src\Core;

	class Route{
		static $GET = [];
		static $POST = [];

		static function init(){
			$get = isset($_GET['url'])? "/".$_GET['url'] : "/";

			foreach(self::${$_SERVER['REQUEST_METHOD']} as $v){
				$v = explode("@",$v);

				$reg = preg_replace("/:([^\/]+)/","([^/]+)",$v[0]);
				$reg = preg_replace("/\//","\\/",$reg);
				if(preg_match("/^".$reg."$/", $get, $p)){
					$src = "src\\Controller\\".$v[1];
					$src = new $src();
					$src->{$v[2]}($p);
					exit;
				}
			}
			move("/","잘못된 접근");
		}

		static function reg($arr){
			foreach($arr as $key => $v){
				self::${strtoupper($v[0])}[] = $v[1];
			}
		}
	}