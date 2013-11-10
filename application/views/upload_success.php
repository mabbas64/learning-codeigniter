<h2>Your file uploaded successfully!</h2>

<ul>
<!-- this displays the uploaded file's information -->
<?php foreach( $upload_data as $key=>$value){
	?>
		<li><?= $key?>: <?= $value ?></li>
		<?php
	}
?>
<a href="<?=base_url()?>upload">Upload another file</a>