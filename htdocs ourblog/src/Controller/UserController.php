<?php 
	namespace src\Controller;

	use src\Core\DB;
	class UserController{
		public function join(){
			$arr = (object)[];
			$arr->article = DB::fetchAll("SELECT * FROM board",[]);
			$arr->userart = DB::fetchAll("SELECT u.*, IFNULL(b.cnt,0) as cnt FROM user as u LEFT JOIN (SELECT COUNT(*) as cnt, uidx FROM board GROUP BY uidx) as b ON u.idx = b.uidx",[]);

			$arr->artCnt = ss()? DB::fetch("SELECT COUNT(*) as cnt FROM board WHERE uidx=?",[ss()->idx])->cnt : '';
			$arr->cnt = DB::fetch("SELECT COUNT(*) as cnt FROM board",[])->cnt;
			$arr->cateCnt = DB::fetchAll("SELECT *,COUNT(*) as cnt FROM board GROUP BY category",[]);
			$arr->cate = ["life","art","fashion","technics","etcs"];
			
			view("user/join",(array)$arr);
		}

		public function join_action(){

			$id = htmlspecialchars($_POST['id']);
			$pw = htmlspecialchars($_POST['pw']);
			$pwck = htmlspecialchars($_POST['pwck']);
			$username = htmlspecialchars($_POST['username']);

			if(empty($id)||empty($pw)||empty($pwck)||empty($username)){
				back("빈 항목을 채워주세요");
			}else if(!preg_match("/^([a-zA-Z0-9]+)@([a-zA-Z]+)(\.[a-zA-Z]+)*(\.[a-zA-Z]{2,3})$/",$id)){
				back("id가 이메일 형식이 아닙니다.");
			}else if($pw != $pwck){
				back("비밀번호와 비밀번호확인의 값이 다릅니다");
			}else{
				DB::exec("INSERT INTO user SET id=?,pw=?,username=?",[$id,$pw,$username]);
				move("/","회원가입 되었습니다.");
			}
			back("아이디 중복");
		}

		public function login_action(){
			$id = htmlspecialchars($_POST['id']);
			$pw = htmlspecialchars($_POST['pw']);
			$row = DB::fetch("SELECT * FROM user WHERE id=? AND pw=?",[$id,$pw]);
			if($row){
				$_SESSION['user'] = $row;
				move("/");
			}
			back("아이디 또는 비밀번호가 틀렸습니다.");
		}

		public function logout(){
			session_unset();
			move("/");
		}
	}