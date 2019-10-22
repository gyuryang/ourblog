	<div class="row">

			<!-- 블로그 글 쓰기 -->
			<div class="col-md-9">

				<!-- 블로그 글쓰기 폼 -->
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title"><h2>회원가입</h2></h3>
					</div>
					<div class="panel-body">

						<form class="form-horizontal" action="/user/join_action" method="post">
							<div class="form-group">
								<label for="userid" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" name="id" id="userid" placeholder="email@domain.com">
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">이름</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="username" id="username" placeholder="이름">
								</div>
							</div>												
							<div class="form-group">
								<label for="userpass" class="col-sm-2 control-label">비밀번호</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="pw" id="userpass" placeholder="비밀번호">
								</div>
							</div>
							<div class="form-group">
								<label for="userpass2" class="col-sm-2 control-label">비밀번호확인</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" name="pwck" id="userpass2" placeholder="비밀번호 확인 ">
								</div>
							</div>																				
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default">회원가입</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>
				<!-- //블로그 글쓰기 폼 -->

			</div>
			<!-- //블로그 글 쓰기 -->

			<!-- 오른쪽 칼럼(로그인, 카테고리, 글쓴이 목록) -->
