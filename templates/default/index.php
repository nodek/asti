<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hello</title>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="templates/default/css/jumbotron-narrow.css" rel="stylesheet">
</head>

<body>

	<div class="container">
	
		<div class="header">
			<ul class="nav nav-pills pull-right">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
			</ul>
			<h3 class="text-muted">Пример</h3>
		</div>

		<div class="jumbotron">
			<h1>Добро пожаловать</h1>
			<p class="lead">Для того чтобы загрузился ваш шаблон, укажите в конфигурационном файле путь к нему</p>
			<p>Кнопки не активные)</p>
			<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p>
		</div>

		<div class="row marketing">
			<div class="col-lg-6">
				<h4>Пример</h4>
				<p>Ниже отобразится первая по счету статья. Для этого создайте в админке 2 статьи</p>
				<h4>Статья №1</h4>
				<p><?php $this->q_articles(1); ?></p>
			</div>

			<div class="col-lg-6">
				<h4>Пример</h4>
				<p>Ниже отобразится вторая по счету статья. Для этого создайте в админке 2 статьи</p>

				<h4>Статья №2</h4>
				<p><?php $this->q_articles(2); ?></p>
			</div>
		</div>

		<div class="footer">
			<p>ASTI Company 2014</p>
		</div>

	</div> 
</body>
</html>
