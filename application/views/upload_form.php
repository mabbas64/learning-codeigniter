<?php echo $error; ?>
<?php echo form_open_multipart(base_url().'upload/do_upload'); ?>

<?php //create the upload input_field
$data_upload_field = array(
		'name' => 'userfile'
	);

echo form_upload($data_upload_field);
?><br />
<?php echo form_submit('', 'Upload file'); ?>

<?php echo form_close(); ?>


