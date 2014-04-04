﻿<!DOCTYPE html>
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
						<li><a href=".">Главная</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Материалы<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="?menu_category">Категории</a></li>
								<li><a href="?menu_articles">Список материалов</a></li>
								<li><a href="?menu_elfinder">Файловый менеджер</a></li>
							</ul>
						</li>
						<li><a href="?menu_settings">Настройки</a></li>
						<li><a href="?menu_about">O CMS</a></li>
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