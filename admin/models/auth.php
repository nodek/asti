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

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
	{    
	$userdata = mysql_fetch_assoc(mysql_query("SELECT * FROM users WHERE users_id = '".intval($_COOKIE['id'])."' LIMIT 1"));

	if(($userdata['users_hash'] !== $_COOKIE['hash']) or ($userdata['users_id'] !== $_COOKIE['id']))		// Проверяем куки
		{
		setcookie('id', '', time() - 60*24*30*12);
		setcookie('hash', '', time() - 60*24*30*12);
		setcookie('errors', '0', time() + 60*24*30*12, '/');
		header('Location: login.php'); exit();
		}
	}
else
	{
	  header('Location: login.php'); exit();
	}

require_once ('views/index.php');				// если авторизован то загружаем views/index.php


?>