<!DOCTYPE html>
<!--
 * ASTI
 * 
 * @author Eselbaev Asyllan
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Авторизация</title>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="views/css/signin.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-signin" role="form" method="post">
			<h2 class="form-signin-heading">Авторизация</h2>
			<input type="text" name="login" class="form-control" placeholder="Логин" required autofocus><br>
			<input type="password" name="password" class="form-control" placeholder="Пароль" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="auth">Войти</button>
		</form>
	</div>

</body>
</html>
