<script src="ueditor.parse.min.js"></script>
<?php 
 ?>

 <div id="content">
 	<?php print_r($_POST); ?>
 </div>

 <script>
 	uParse('#content', {
    rootPath: './'  //ueditor所在的路径，这个要给出，让uparse能找到third-party目录
})
 </script>