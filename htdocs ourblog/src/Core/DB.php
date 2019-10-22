<?php 
	namespace src\Core;

	class DB{
		static $db;
		static function getDB(){
			if(is_null(self::$db)){
				self::$db = new \PDO("mysql:host=localhost; charset=utf8mb4; dbname=ourblog","root","",[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ]);
			}
			return self::$db;
		}
		static function exec($sql,$d){
			$row = self::getDB()->prepare($sql);
			try{
				$row->execute($d);
				return true;
			}catch(\Exception $e){
				$e->getMessage();
				return false;
			}
		}
		static function fetch($sql,$d){
			$row = self::getDB()->prepare($sql);
			$row->execute($d);
			return $row->fetch();
		}
		static function fetchAll($sql,$d){
			$row = self::getDB()->prepare($sql);
			$row->execute($d);
			return $row->fetchAll();
		}
		static function lastInsertId(){
			return self::getDB()->lastInsertId();
		}
	}