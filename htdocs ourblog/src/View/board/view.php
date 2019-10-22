<div class="row">

			<!-- 블로그 글 본문 보기 -->
			<div class="col-md-9">

				<!-- 블로그 글 -->
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><h2><?= $view->title ?></h2></h3>
					</div>
					<div class="panel-body">
						<p>
							<?= !empty($view->img)?'<img class="img-responsive" src="/upload/'.$view->img.'" alt="image sample">' : ''?>
							<?= $view->content ?>
						</p>
					</div>
					<div class="panel-footer">
						<div class="row">
							<div class="col-md-6"><span class="category"><strong>[<?= $view->category ?>]</strong></span>&nbsp;&nbsp;<span class="writer"><?= $view->username ?></span>&nbsp;&nbsp;<span class="date"><?= $view->write_date ?></span>&nbsp;&nbsp;<span class="commentcount">댓글수 <span class="badge"><?= empty($comentCnt->cnt)? 0 : $comentCnt->cnt ?></span></span></div>
							<div class="col-md-6 btns">
								<?php if(isset(ss()->idx)&&ss()->idx == $view->uidx) : ?>
								<a href="/board/modify/<?= $aidx ?>" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> 수정</a>
								<a href="" class="btn btn-danger del" data-idx="<?= $aidx ?>" data-table="board" data-uidx="<?= ss()->idx ?>"><span class="glyphicon glyphicon-trash"></span> 삭제</a>
								<?php endif; ?>
								<a href="/" class="btn btn-primary"><span class="glyphicon glyphicon-th-list"></span> 목록으로</a>
							</div>
						</div>						
					</div>
				</div>
				<!-- //블로그 글 -->

				<!-- 댓글 폼 -->
				<?php if(ss()) : ?>
				<div class="row">
					<form class="form-horizontal" action="/board/coment_create" method="post">
						<div class="form-group">
							<input type="hidden" value="<?= $aidx ?>" name="aidx">
							<label for="userid" class="col-sm-2 control-label">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" name="id" id="userid" placeholder="<?= ss()->id ?>" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">댓글내용</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="3" name="content" id="comment"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-default">댓글저장</button>
							</div>
						</div>
					</form>
				</div>
				<?php endif; ?>
				<!-- //댓글 폼 -->

				<!-- 댓글 리스트 -->
				<div class="commentlist">
					<?php foreach($coment as $v){ ?>
					<div class="comment">
						<h3><?= $v->username ?> <?= $v->id ?> <?= $v->write_date ?></h3>
						<p><?= $v->content ?><?php if(ss()&&$v->id == ss()->id) : ?><a href="#" class="btn btn-xs btn-danger del" data-idx="<?= $v->idx ?>" data-table="coment" data-uidx="<?= ss()->idx ?>"><span class="glyphicon glyphicon-trash"></span><?php endif; ?></a></p>
					</div>
					<?php } ?>
				</div>
				<!-- //댓글 리스트 -->

			</div>