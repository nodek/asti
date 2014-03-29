<?php

require_once('../modules/tinymce/tinymce.php');

?>
<h2 align="center">Создать статью</h2>
<br>
<p>Заголовок</p>
<form method="post">
<input type="text"  class="form-control" name="article_title" /><br><br>
<p>Текст</p>
<textarea name="article_text"></textarea><br>
<span class="btn-right"><input type="submit" name="submit_cr" class="btn btn-primary btn-lg active" align="right" value="Создать" /></span>
</form>
