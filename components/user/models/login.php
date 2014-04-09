<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt    $dir, $_POST['login'], $_POST['password']
 */

defined('_Asti') or die;

if(!empty($_POST['login']) && !empty($_POST['password']))
	{
	$user_login = mysql_real_escape_string(strip_tags($_POST['login'], ENT_QUOTES));
	$user_pass = $_POST['password'];
	$find_user = mysql_query("SELECT COUNT(users_id) FROM `users` WHERE `users_login` = '$user_login';");
	if(mysql_result($find_user, 0) > 0)
		{
		$select = mysql_fetch_assoc(mysql_query("SELECT `users_password`, `users_login` FROM `users` WHERE `users_login` = '$user_login';"));
		$pass = $select['users_password'];
		if(CRYPT($user_pass, $pass) == $pass)
			{
			$_SESSION['user_name'] = $select['users_login'];
			$_SESSION['login_status'] = 1;
			}
		else
			echo "Указан неверный пароль";
		}
	else
		echo "Указан неверный логин";
	}

?>
