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
	<h1>Abbas' CI Blog - first project</h1>
	<?php 
	if(!isset($posts))
		echo '<p>There are currently NO posts on abbas blog</p>';
	else
	{
		foreach($posts as $row){
			echo '<h2>'.$row['title'].'</h2><hr />';
		}
	}
	?>

</div>
</body>
</html>