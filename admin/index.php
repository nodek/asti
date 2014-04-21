<?php
/**
 * ASTI
 * 
 * @author Eselbaev Asyllan
 * @link http://astana-it.kz
 * @copyright  Copyright (C) 2014. Astana - IT. All rights reserved.
 * @license    GNU General Public License; see LICENSE.txt
 */

define('_Asti', 1);

require_once('controllers/admin.php');

$admin = new admin;
$admin->start();			// Запускаем функцию start

?>