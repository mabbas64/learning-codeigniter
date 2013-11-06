<!DOCTYPE html>
<html>
<head><title>CI Blog by Abbas</title></head>
<style>
	#wrapper{
		margin: 0 auto;
		width: 960px;
		border: 1px solid #0d0d0d;
		padding: 3px;
	}
	h1{
		background: #2d2d2d;
		padding: 3px;
		font-family: Arial, Verdana;
		font-size: 22px;
		color: #dfdfdf;
	}

</style>
<body>
<div id="wrapper">	
	<h1>Abbas' CI Blog :: SINGLE POST  </h1>
	<?php 
	if(!isset($post))
		echo '<p>There are  NO posts with this PostID on abbas blog</p>';
	else
	{
		//foreach($post as $row){
			?>
			 	<h2><a href="<?=base_url()?>posts/post/<?=$post["postID"]?>"><?=$post['title']?></a></h2><p><?=$post['post']?></p><hr /> 
			<?php
		//}
	}
	?>

</div>
</body>
</html>