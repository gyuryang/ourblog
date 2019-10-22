<div class="col-md-3">

				<div class="loginarea">
					<div class="panel panel-default">
					<div class="panel-body">
						<?php if(!ss()) : ?>
						<form class="form-horizontal" action="/user/login_action" method="post">
						  <div class="form-group">
						    <div class="col-sm-12">
						      <input type="email" class="form-control" name="id" id="userid" placeholder="email@domain.com">
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-12">
						      <input type="password" class="form-control" name="pw" id="userpass" placeholder="비밀번호">
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-12">
						      <button type="submit" class="btn btn-default">로그인</button>
						      </form>
						      <button type="button" class="btn btn-info" onclick="window.location='/user/join'">회원가입</button>
						    </div>
						  </div>
						</div>
						</div>
						  <?php else : ?>
						  <div class="form-group">
						    <div class="col-sm-12">
						      <h4>username : <?= ss()->username ?></h4>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-12">
						      <h4>email : <?= ss()->id ?></h4>
						    </div>
						  </div>
						  <div class="form-group">
						    <div class="col-sm-12">
						      <h4>article : <?= $artCnt ?></h4>
						    </div>
						  </div>
						  <div class="form-group">
						  	<div class="col-sm-12">
						      <button type="submit" class="btn btn-default" onclick="window.location='/user/logout'">로그아웃</button>
						  </div>
						  </div>
					</div>
					</div>					
				</div>

				<div>
					<a href="/board/write" class="writebtn btn btn-primary btn-lg col-sm-12"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
				</div>
				<?php endif; ?>
				<div class="categories">
					<h3>Categories</h3>
					<ul>
						<li><a style="text-decoration: none; color:black" href="/">전체보기 <span class="badge"><?= $cnt ?></span></a></li>
						<?php foreach($cate as $v){ ?>
						<li><a style="text-decoration: none; color:black" href="/main/1/<?= $v ?>"><?= $v ?><span class="badge"><?php foreach ($cateCnt as $val) {?><?= $v==$val->category? $val->cnt : '' ?><?php } ?></span></a></li>
						<?php } ?>
					</ul>
				</div>

				<div class="authors">
					<h3>Authors</h3>
					<ul>
						<?php foreach($userart as $v){ 
							if(!empty($v->cnt)) :?>
							<li><a style="text1-decoration: none; color:black" href="/authors/1/<?=$v->idx?>"><?= $v->username ?><span class="badge"><?= $v->cnt ?></span></a></li>
						<?php endif;} ?>
					</ul>					
				</div>

			</div>
			<!-- 오른쪽 칼럼(로그인, 카테고리, 글쓴이 목록) -->

		</div>
		<div class="footer">
			Copyright &copy; <strong>Our Blog</strong> All rights reserved.
		</div>
	</div>
</body>
<script>
	$(".categories .badge").each(function(){
		if($(this).text()=='') $(this).text('0');
	})
	$(".del").click(function(){
		if(!confirm("정말 삭제 하시겠습니까?"))
			return;
		let idx = $(this).data('idx');
		let table = $(this).data('table');
		let uidx = $(this).data('uidx');
        $.ajax({
            url : '/board/del',
            type : 'POST',
 	        data : {idx:idx, table:table, uidx:uidx},
 	        success: _ => location.replace("/")
        })
	})
</script>
</html>