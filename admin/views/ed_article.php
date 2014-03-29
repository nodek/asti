<?php

require_once('../modules/tinymce/tinymce.php');

?>
<h2 align="center">Редактировать статью</h2>
<br>
<p>Заголовок</p>
<form method="post">
<input type="hidden" name="article_id_ed" value="<?php echo $article_id_ed ?>"/>
<input type="text" class="form-control" name="article_title_ed" value="<?php echo $article_title_ed ?>" /><br><br>
<p>Текст</p>
<textarea name="article_text_ed">
<?php 
	echo $article_text_ed;
?>
</textarea><br>
<span class="btn-right"><input type="submit" name="submit_ed" class="btn btn-primary btn-lg active" align="right" value="Сохранить" /></span>
</form>
