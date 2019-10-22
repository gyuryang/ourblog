		<div class="row">

			<!-- 블로그 글 목록 -->
			<div class="col-md-9">

				<!-- 블로그 글 -->
				<?php foreach($article as $key => $v){ 
					if((int)$page*5>$j && (int)$page*5-5<=$j) : ?>
						

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><h2><?= $v->title ?></h2></h3>
					</div>
					<div class="panel-body">
						<p>
							<?php if(!empty($v->img)) : ?>
								<img class="img-responsive list-img" src="/upload/<?= $v->img ?>" width="200" height="133" alt="image sample" align="left">
							<?php endif; ?>
							<?= $v->content ?>
						</p>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6"><span class="category"><strong><?= $v->category ?></strong></span>&nbsp;&nbsp;<span class="writer"><?= $v->username ?></span>&nbsp;&nbsp;<span class="date"><?= $v->write_date ?></span>&nbsp;&nbsp;<span class="commentcount">댓글수 <span class="badge"><?= $v->cnt ?></span></span></div>
							<div class="col-md-6 btns">
								<?php if(isset(ss()->idx)&&$v->uidx == ss()->idx): ?>
								<a href="/board/modify/<?= $v->idx ?>" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> 수정</a>
								<a href="" class="btn btn-danger del" data-idx="<?= $v->idx?>" data-table="board" data-uidx="<?= ss()->idx ?>"><span class="glyphicon glyphicon-trash"></span> 삭제</a>
								<?php endif; ?>
								<a href="/view/<?= $v->idx ?>" class="btn btn-primary"><span class="glyphicon glyphicon-zoom-in"></span> 더보기</a>
							</div>
						</div>						
					</div>
				</div>
				<?php endif; $j++;} ?>
				<!-- //블로그 글 -->
				
				<!-- 페이지네이션(pagination) -->
				<nav>
					<ul class="pagination pagination-lg">
						<?php if($page!="1") : ?>
						<li>
							<a href="/main/<?= $page-1 ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							</a>
						</li>
						<?php endif; ?>
						<!-- <li class="active"><a href="#">1</a></li> -->
						<?php foreach($article as $key => $v ){ 
							if($i%5 == 0):	?>
							<li class="<?= isset($page)&&$page == $i/5? 'active' : '' ?>"><a href="<?= $uidx == "ALL"? $category=="ALL"? '/main/'.($i/5) : '/main/'.($i/5).'/'.$category : '/authors/'.($i/5).'/'.$uidx; ?>"><?= $i/5 ?></a></li>
						<?php endif; $i++;} ?>
						<?php if($page!=floor($i/5)) : ?>
						<li>
							<a href="/main/<?= $page+1 ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							</a>
						</li>
						<?php endif; ?>
					</ul>
				</nav>				

			</div>
			<!-- //블로그 글 목록 -->

			<!-- 오른쪽 칼럼(로그인, 카테고리, 글쓴이 목록) -->
