<?php
/*Must have this sample code to add the tinymce to (or something along these lines)

<div class="textarea-container">
	<textarea></textarea>
</div><br/>
<?php
	require_once 'core/lib/addTinymce.php';
	//addEdit();

?>
*/

function addEdit() {
?>
<script type="text/javascript" src="<?php echo WWW; ?>/core/lib/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",theme: "modern",width: 680,height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"<?php echo WWW; ?>/core/lib/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "<?php echo WWW; ?>/core/lib/filemanager/plugin.min.js"}
 });
</script>

<?php
}

?>