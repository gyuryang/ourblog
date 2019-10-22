<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>Our Blog</title>
	<link rel="stylesheet" href="/Layout/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Layout/css/style.css">
	<script src="/Layout/js/jquery-1.12.3.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
  	<h1><a href="/">Our Blog</a></h1>
  	<p>Our Blog는 우리의 꿈과 희망을 나누는 곳입니다.</p>
  	<p>
			<form class="form-inline" role="search" action="/view/search/1/<?= $category != 'ALL'? $category : ''?><?= $uidx!="ALL"? $uidx : '' ?>" method="post">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="search">
				</div>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</form>
  	</p>
	</div>