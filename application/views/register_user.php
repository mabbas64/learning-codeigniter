<h2>Register User</h2>
 
<?php echo form_open(base_url().'users/register'); ?>
<p><?= form_label('Username','username'); ?> <?php
$data_username = array(
		'name' => 'username',
		'id' => 'username',
		'size' => '50',
		'style' => 'border: 1px solid #0d0d0d'
	);
echo form_input($data_username); ?></p>
<p><?= form_label("Password",'password'); ?> <?php
$data_password = array(
		'name' => 'password',
		'id' => 'password',
		'size' => 50,
		'class' => 'blackborder'
	);
echo form_password($data_password); ?></p>
<p>User Type: <?php
$options = array(
		'' => 'Select a user type',
		'admin' => 'Admin',
		'author' => 'Author',
		'user' => 'User'
	);
echo form_dropdown('user_type',$options,'admin'); // (input_name, options_array, default_selected_option) ?></p>
<p><?php echo form_submit('','Register!'); ?></p>
<?php form_close(); ?>


<!-- Form Helper version above, HTML version below.
<form action="<?=base_url()?>users/register" method="post">
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

</form> HTML-only form.
-->