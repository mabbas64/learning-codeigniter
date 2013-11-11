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
	?><hr />
	<!-- Comments section -->
	<h2>Comments</h2>
	<?php if(count($comments) > 0){
			foreach($comments as $row){ ?>
		<p><strong><?=$row['username']?></strong> said at <?=$row['date_added']?><br /><?=$row['comment']?><br />
		<hr />
	<?php }
		} 
		else{

				echo 'There are currently no comments!';
			}
		?>
	<!-- comment form -->
	<?php echo form_open(base_url().'comments/add_comment/'.$post['postID']); 
		$data_commentfield = array(
			'name' => 'comment'
		);
		echo form_textarea($data_commentfield); ?>
		<br />
		<p><?php echo form_submit('','Add Comment'); ?></p>
	<?php echo form_close(); ?>

</div>
</body>
</html>