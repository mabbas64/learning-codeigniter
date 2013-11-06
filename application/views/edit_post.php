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
	<h1>Abbas' CI Blog > Edit POST  </h1>

	<?php
		if($success==1){
			echo "<div class='msg'> This Post has been updated!</div>";
		}
	?>

	<form action="<?=base_url()?>posts/edit_post/<?=$post['postID']?>" method="post">
	<p>Title: <input name="title" type="text" value="<?=$post['title']?>" /></p>
	<p>Description: <textarea name="post"><?=$post['post']?></textarea></p>
	<p><input type="submit" value="Edit Post" /></p>
	</form>
	 

</div>
</body>
</html>