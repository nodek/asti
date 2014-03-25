<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="views/css/navbar.css" rel="stylesheet">
<link href="views/css/articles.css" rel="stylesheet">
</head>
<body>
	<div class="container">

		<div class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">Админка</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="?articles">Статьи</a></li>
						<li><a href="?about">O CMS</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="?exit">Выйти</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="jumbotron">
			<?php
			$this->content();
			?>
		</div>
	</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../modules/bootstrap/js/bootstrap.js"></script>
</body>
</html>