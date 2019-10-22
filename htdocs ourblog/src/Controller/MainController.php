<?php 
	namespace src\Controller;

	use src\Core\DB;
	class MainController
	{
		public function main($p){
			$arr = (object)[];
			$arr->page = isset($p[1])? $p[1] : 1;

			$arr->i = 5;
			$arr->j = 0;

			$arr->category = isset($p[2])&&(int)$p[2]==0 ? $p[2] : "ALL";
			$arr->uidx = isset($p[2])&&(int)$p[2]!=0? $p[2] : "ALL";
			$arr->search = isset($_POST['search'])? $_POST['search'] : '';
			$arr->article = $arr->category == "ALL"? DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx",[]) : DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx WHERE category=?",[$arr->category]);
			$arr->article = $arr->uidx == "ALL"? $arr->article : DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx WHERE uidx=?",[$arr->uidx]);

			$arr->article = (!empty($arr->search)&&$arr->category=="ALL"&&$arr->uidx=="ALL"?  DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx WHERE title LIKE '%$arr->search%' OR content LIKE '%$arr->search%'",[]) :
			(!empty($arr->search)&&$arr->category!="ALL"? DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx WHERE (title LIKE '%$arr->search%' OR content LIKE '%$arr->search%') AND b.category=?",[$arr->category]) :
			(!empty($arr->search)&&$arr->uidx!="ALL"? DB::fetchAll("SELECT b.*,IFNULL(c.cnt,0) as cnt FROM board as b LEFT JOIN (SELECT COUNT(*) as cnt, aidx FROM coment GROUP BY aidx) as c ON b.idx=c.aidx WHERE (title LIKE '%$arr->search%' OR content LIKE '%$arr->search%') AND b.uidx=?",[$arr->uidx]) : $arr->article)));

			//IFNULL은 첫번쨰 인자값이 null이면 두번째인자를 반환함
			//위의 쿼리문에서 GROUP BY는 uidx를 기준으로 그룹화함 COUNT를 하면 전체의 cnt를 가져오지만 GROUP BY를 기준으로 각각 가져옴
			//ON과 WHERE은 조금 다름 ON이 fetchAll이라면 WHERE은 fetch로 한개만 봄
			//나머지는 JOIN의 문법 u.*은 user의 모든 컬럼을 사용할수있고 board에서 uidx는 board의 uidx만 사용가능함 b.uidx 이런식으로
			
			$arr->userart = DB::fetchAll("SELECT u.*, IFNULL(b.cnt,0) as cnt FROM user as u LEFT JOIN (SELECT COUNT(*) as cnt, uidx FROM board GROUP BY uidx) as b ON u.idx = b.uidx",[]);
			$arr->artCnt = ss()? DB::fetch("SELECT COUNT(*) as cnt FROM board WHERE uidx=?",[ss()->idx])->cnt : '';
			$arr->cnt = DB::fetch("SELECT COUNT(*) as cnt FROM board",[])->cnt;
			$arr->cateCnt = DB::fetchAll("SELECT *,COUNT(*) as cnt FROM board GROUP BY category",[]);
			$arr->cate = ["life","art","fashion","technics","etcs"];
			
			
			view("main",(array)$arr);
		}
	}