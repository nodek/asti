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
require_once('../modules/tinymce/tinymce.php');

?>
<h2 align="center">Создать материал</h2>
<br>
<p>Заголовок</p>
<form method="post">
<input type="text"  class="form-control" name="article_title" /><br><br>
<p>Категория</p>
<?php category($article_category_ed); ?><br><br>
<p>Текст</p>
<textarea name="article_text"></textarea><br>
<span class="btn-right"><input type="submit" name="submit_cr" class="btn btn-primary btn-lg active" align="right" value="Создать" /></span>
</form>
