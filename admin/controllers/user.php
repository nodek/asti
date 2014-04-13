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

class user
	{

	public function start()
		{
		session_start();
		if(isset($_GET['menu']) && $_GET['menu'] == 'exit')
			$this->logout();
		if(isset($_POST['auth']))
			$this->login();
		}

	function logged()
		{
		if (isset($_SESSION['login_status']) AND $_SESSION['login_status'] == 1)
			return true;
		return false;
		}

	function login()
		{
		require_once('models/login.php');
		}

	function logout()
		{
		$_SESSION = array();
		session_destroy();
		header('Location: .');
		}
	function register()
		{
		require_once('models/register.php');
		$register = new register;
		$register->reg_user();
		}
	
	}

?>