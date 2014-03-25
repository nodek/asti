<script type="text/javascript" src="modules/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
        tinymce.init({
			selector:'textarea',
			theme: 'modern',
			plugins: [
				"advlist autolink lists link image charmap print preview hr anchor pagebreak",
				"searchreplace wordcount visualblocks visualchars code fullscreen",
				"insertdatetime media nonbreaking save table contextmenu directionality",
				"emoticons template paste textcolor"
					],
			toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
			toolbar2: "print preview media | forecolor backcolor emoticons",
			image_advtab: true,
			templates: [
				{title: 'Test template 1', content: 'Test 1'},
				{title: 'Test template 2', content: 'Test 2'}
					]
			});
</script>
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
