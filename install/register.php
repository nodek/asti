<!DOCTYPE html>
<!--
 * ASTI
 * 
 * @author Eselbaev A
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
<title>Регистрация</title>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="signin.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<form class="form-signin" role="form" method="post">
			<h2 class="form-signin-heading">Регистрация</h2>
			<input type="text" name="user_login" class="form-control" placeholder="Логин" required autofocus><br>
			<input type="password" name="user_pass_new" class="form-control" placeholder="Пароль" required>
			<input type="password" name="user_pass_repeat" class="form-control" placeholder="Повторите пароль" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Зарегистрировать</button>
		</form>
	</div>

</body>
</html>
<?php
define('_Asti', 1);
if(isset($_POST['register']))
{

require_once('../components/user/models/register.php');
$register = new register;
$register->reg_user();

}
?>