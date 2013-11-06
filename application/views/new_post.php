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
	<h1>Abbas' CI Blog > new POST  </h1>

	<form action="<?=base_url()?>posts/new_post" method="post">
	<p>Title: <input name="title" type="text" /></p>
	<p>Description: <textarea name="post"></textarea></p>
	<p><input type="submit" value="Add Post" /></p>
	</form>
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