<?php 
	namespace src\Controller;

	use src\Core\DB;

	class BoardController{
		public function write(){
			$arr = (object)[];
			$arr->article = DB::fetchAll("SELECT * FROM board",[]);
			$arr->userart = DB::fetchAll("SELECT u.*, IFNULL(b.cnt,0) as cnt FROM user as u LEFT JOIN (SELECT COUNT(*) as cnt, uidx FROM board GROUP BY uidx) as b ON u.idx = b.uidx",[]);

			$arr->artCnt = ss()? DB::fetch("SELECT COUNT(*) as cnt FROM board WHERE uidx=?",[ss()->idx])->cnt : '';
			$arr->cnt = DB::fetch("SELECT COUNT(*) as cnt FROM board",[])->cnt;
			$arr->cateCnt = DB::fetchAll("SELECT *,COUNT(*) as cnt FROM board GROUP BY category",[]);
			$arr->cate = ["life","art","fashion","technics","etcs"];
			view("board/write",(array)$arr);
		}

		public function write_action(){
			// $id = htmlspecialchars($_POST['id']);
			$category = htmlspecialchars($_POST['category']);
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);

			$img = $_FILES["upimg"]["name"];
			$date = date("Y-m-d H:i:s");

			$imgtype = substr($img, (mb_strlen($img) - strpos($img,"."))*-1+1);
			$readyImg = explode(".",$img);
			
			if($imgtype!="jpg" && $imgtype!="jpeg" && $imgtype != "png" && $imgtype != "gif" && !empty($imgtype)){
				back("파일 첨부는 이미지만 가능합니다.");
			}else if(empty(trim($content)) || empty(trim($title))){
				back("빈 칸을 채워주세요");
			}
			if($category != "life" && $category != "art" && $category != "fashion" && $category != "technics" && $category != "etcs"){
				back("존재하는 카테고리 중에서 골라주세요.");
			}
			if(!empty($img)&&DB::fetch("SELECT * FROM board WHERE img=?",[$img])){
				$img = $readyImg[0].(rand()*rand()).".".$imgtype;
			}
			if(empty($imgtype) || move_uploaded_file($_FILES["upimg"]["tmp_name"], "upload/".$img)){
				DB::exec("INSERT INTO board SET category=?,title=?,content=?,username=?,write_date=?,uidx=?,img=?",[$category,$title,$content,ss()->username,$date,ss()->idx,$img]);
				// $idx = DB::lastInsertId();
				move("/main/1");
			}else if(!empty($imgtype)){
				back("이미지 업로드 실패");
			}
		}
		public function view($p){
			$arr = (object)[];
			$arr->aidx = $p[1];

			$arr->article = DB::fetchAll("SELECT * FROM board",[]);
			$arr->userart = DB::fetchAll("SELECT u.*, IFNULL(b.cnt,0) as cnt FROM user as u LEFT JOIN (SELECT COUNT(*) as cnt, uidx FROM board GROUP BY uidx) as b ON u.idx = b.uidx",[]);
			$arr->artCnt = ss()? DB::fetch("SELECT COUNT(*) as cnt FROM board WHERE uidx=?",[ss()->idx])->cnt : '';
			$arr->cnt = DB::fetch("SELECT COUNT(*) as cnt FROM board",[])->cnt;
			$arr->cateCnt = DB::fetchAll("SELECT *,COUNT(*) as cnt FROM board GROUP BY category",[]);
			$arr->cate = ["life","art","fashion","technics","etcs"];

			$arr->view = DB::fetch("SELECT * FROM board WHERE idx=?",[$arr->aidx]);
			if(empty($arr->view))
				back("잘못된 접근");
			$arr->coment = DB::fetchAll("SELECT * FROM coment WHERE aidx=?",[$arr->aidx]);
			$arr->comentCnt = DB::fetchAll("SELECT COUNT(*) as cnt FROM coment WHERE aidx=?",[$arr->aidx])[0];
			view("board/view", (array)$arr);
		}
		public function coment_create(){
			DB::exec("INSERT INTO coment SET id=?,content=?,write_date=?,username=?,aidx=?",[ss()->id,htmlspecialchars($_POST['content']),date("Y-m-d H:i:s"),ss()->username,$_POST['aidx']]);
			chr(ss()->id);
			back();
		}
		public function del(){
			$table = $_POST['table'];
			if(ss()->idx != $_POST['uidx'] || ($table != 'board' && $table != 'coment'))
				exit;
			DB::exec("DELETE FROM $table WHERE idx=?",[$_POST['idx']]);
			if($table == 'board')
				DB::exec("DELETE FROM coment WHERE aidx=?",[$_POST['idx']]);
		}
		public function modify($p){
			$arr = (object)[];
			$arr->aidx = $p[1];

			$arr->article = DB::fetchAll("SELECT * FROM board",[]);
			$arr->userart = DB::fetchAll("SELECT u.*, IFNULL(b.cnt,0) as cnt FROM user as u LEFT JOIN (SELECT COUNT(*) as cnt, uidx FROM board GROUP BY uidx) as b ON u.idx = b.uidx",[]);
			$arr->artCnt = ss()? DB::fetch("SELECT COUNT(*) as cnt FROM board WHERE uidx=?",[ss()->idx])->cnt : '';
			$arr->cnt = DB::fetch("SELECT COUNT(*) as cnt FROM board",[])->cnt;
			$arr->cateCnt = DB::fetchAll("SELECT *,COUNT(*) as cnt FROM board GROUP BY category",[]);
			$arr->cate = ["life","art","fashion","technics","etcs"];
			$arr->view = DB::fetch("SELECT * FROM board WHERE idx=?",[$arr->aidx]);
			if(isset($arr->view) || ss()->idx != $view->uidx)
				back("잘못된 접근");
			view("board/modify",(array)$arr);
		}
		public function modify_action(){
			$aidx = $_POST['aidx'];
			$category = htmlspecialchars($_POST['category']);
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);
			$img = $_FILES["upimg"]["name"];

			$imgtype = substr($img, (mb_strlen($img) - strpos($img,"."))*-1+1);
			$readyImg = explode(".",$img);
			
			if($imgtype!="jpg" && $imgtype!="jpeg" && $imgtype != "png" && $imgtype != "gif" && !empty($imgtype)){
				back("파일 첨부는 이미지만 가능합니다.");
			}else if(empty(trim($content)) || empty(trim($title))){
				back("빈 칸을 채워주세요");
			}
			if($category != "life" && $category != "art" && $category != "fashion" && $category != "technics" && $category != "etcs"){
				back("존재하는 카테고리 중에서 골라주세요.");
			}
			if(!empty($img)&&DB::fetch("SELECT * FROM board WHERE img=?",[$img])){
				$img = $readyImg[0].(rand()*rand()).".".$imgtype;
			}
			if(!empty($imgtype) && move_uploaded_file($_FILES["upimg"]["tmp_name"], "upload/".$img)){
				DB::exec("UPDATE board SET img=? WHERE idx=?",[$img,$aidx]);
			}
			DB::exec("UPDATE board SET category=?,title=?,content=? WHERE idx=?",[$category,$title,$content,$aidx]);
			move("/");
		}
	}
