<h2>Login</h2>
<?php if($error==1){ ?>
	Your username/password did not match
<?php } ?>
<form action="<?=base_url()?>users/login" method="post">
<p>Username<input type="text" name="username" /></p>
<p>Password<input type="text" name="password" /></p>
<p>User Type:
	<select name="user_type">
		<option value="" selected="selected">--</option>
		<option value="admin">Admin</option>
		<option value="author">Author</option>
		<option value="user">User</option>
	</select>
<p><input type="submit" value="Login" /></p>

</form>