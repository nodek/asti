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
<h2 align="center">Создать статью</h2>
<br>
<p>Заголовок</p>
<form method="post">
<input type="text"  class="form-control" name="article_title" /><br><br>
<p>Текст</p>
<textarea name="article_text"></textarea><br>
<span class="btn-right"><input type="submit" name="submit_cr" class="btn btn-primary btn-lg active" align="right" value="Создать" /></span>
</form>
