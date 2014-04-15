<?php
/**
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

defined('_Asti') or die;

if(!empty($_POST['login']) && !empty($_POST['password']) && preg_match('/^[a-z\d]{4,20}$/i', $_POST['login']))
	{
	$user_login = $_POST['login'];
	$user_pass = $_POST['password'];
	$find_user = mysql_query("SELECT COUNT(user_id) FROM `users` WHERE `user_login` = '$user_login';");
	if(mysql_result($find_user, 0) > 0)
		{
		$select = mysql_fetch_assoc(mysql_query("SELECT `user_password`, `user_login`, `user_role` FROM `users` WHERE `user_login` = '$user_login';"));
		$pass = $select['user_password'];
		
		if($select['user_role'] == 'admin')
			{
			if (version_compare(PHP_VERSION, '5.5', '>='))
				{
				if(password_verify($user_pass, $pass))
					{
					$_SESSION['user_name'] = $select['user_login'];
					$_SESSION['login_status'] = 1;
					}
				else
					echo "Указан неверный пароль";				
				}
			else
				{
				if(CRYPT($user_pass, $pass) == $pass)
					{
					$_SESSION['user_name'] = $select['user_login'];
					$_SESSION['login_status'] = 1;
					}
				else
					echo "Указан неверный пароль";
				}
			}
		else
			echo "В админку может входить только админ сайта";
		}
	else
		echo "Указан неверный логин";
	}

?>
