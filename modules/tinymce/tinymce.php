<script type="text/javascript" src="../modules/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
        tinymce.init({
			selector:'textarea',
			theme: 'modern',
			language : 'ru',
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
					],
    file_browser_callback : function (field_name, url, type, win) 
					{
					tinymce.activeEditor.windowManager.open({
					file: '../modules/elfinder/elfinder.php',
					title: 'elFinder 2.0',
					width: 900,  
					height: 450,
					resizable: 'yes'
					}, 
					{
					setUrl: function (url) {
					win.document.getElementById(field_name).value = url;
					}
					});
					return false;
					}
			});
</script>