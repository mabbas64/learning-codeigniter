<?php if($this->session->userdata('userID')){  ?>
		You're logged in!
		<p><a href="<?=base_url()?>users/logout">Logout</a></p>
<?php }
 	  else{ ?>
		<p><a href="<?=base_url()?>users/login">Login</a></p>
<?php }
?>
	<h1>Abbas' CI Blog - first project | <a href="<?=base_url()?>posts/new_post/">Add Post></a> </h1>
	<?php 
	if(!isset($posts))
		echo '<p>There are currently NO posts on abbas blog</p>';
	else
	{
		foreach($posts as $row){
			?>
			 	<h2>
			 		<a href="<?=base_url()?>posts/post/<?=$row["postID"]?>"><?=$row['title']?></a>
			 		<a href="<?=base_url()?>posts/edit_post/<?=$row['postID']?>">Edit</a>
			 		<a href="<?=base_url()?>posts/delete_post/<?=$row['postID']?>">Delete</a>
			 	</h2>
			 	<p><?=$row['post']?></p><hr /> 
			<?php
		}
		//add pagination here
		?>
		<?=$pages?>
		<?php
	}
	?>

