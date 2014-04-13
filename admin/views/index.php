<!DOCTYPE html>
<!--
 * ASTI
 * 
 * @author Eselbaev A
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
-->
<?php

defined('_Asti') or die;

?>
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
					<a class="navbar-brand" href="#">ASTI</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href=".">Главная</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Материалы<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="category">Категории</a></li>
								<li><a href="articles">Список материалов</a></li>
								<li><a href="elfinder">Файловый менеджер</a></li>
							</ul>
						</li>
						<li><a href="settings">Настройки</a></li>
						<li><a href="about">O CMS</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="exit">Выйти</a></li>
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
<div align="center">
	<span class="copyright">
	Powered by <a href="http://astana-it.kz" target="_blank">Astana IT</a>
	</span>
</div>
</html>