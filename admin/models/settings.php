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

require_once('views/settings.php');

function t_default()
	{
	$config  = file_get_contents('../config/config.php');
	$template = explode(" ", $config);
	$template = str_replace("\"", "", $template);
	echo "<p class = 'jumbotron template'>".$template[2]."</p>";
	}
function template()
	{
	$dir    = '../templates/';
	$skip = array('.', '..', '.htaccess');
	$files1 = scandir($dir);
	echo "<select class='form-control min' name='template_ed'>";
	foreach($files1 as $file)
		{
		if(!in_array($file, $skip))
		echo "<option value='$file'>$file</option>";
		}
	echo "</select>";
	}

if(isset($_POST['submit_template']) && !empty($_POST['template_ed']))
	{
	$line="3";
	$replace="define ('template', \"".$_POST['template_ed']."\" );";
	 
	$file=file("../config/config.php");
	$open=fopen("../config/config.php","w");
	 
	for($i=0;$i<count($file);$i++)
		{
		if(($i+1)!=$line)
			{
			fwrite($open,$file[$i]);
			}
		else
			{
			fwrite($open,$replace."\r\n");
			}
		}

	fclose($open);
	header("Location: ?menu_settings");
	echo "<p class='p-signin'>Настройки успешно применены</p><br><br>";
	}

?>