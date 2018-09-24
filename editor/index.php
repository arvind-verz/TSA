<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
</head>

<body>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="fancybox/jquery.fancybox.js"></script>
<script>
tinymce.init({
    selector: "textarea#elm1",
    theme: "modern",
    width: 900,
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager,emoticons"
   ],
   content_css: "css/content.css",  
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code | edit  tools, emoticons",
   image_advtab: true ,   
   external_filemanager_path:"http://localhost/CodeIgniter/fundus/editor/filemanager/",
   filemanager_title:"JK Filemanager" ,
   external_plugins: { "filemanager" : "http://localhost/CodeIgniter/fundus/editor/filemanager/plugin.min.js"}
 }); 
</script>

<!-- place in body of your html document -->
<textarea id="elm1" name="area" class="tinymce"></textarea>

</body>
</html>
