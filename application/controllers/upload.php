<?php

class Upload extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper('form'); //this'll be loaded on every func within the class as this is the constructur func of this class.
		// we load ^ this form Helper as we need to use the form on the upload page in one of functions below (the do_upload func)
	}

	function index(){
		// pass an empty error array (this is echoed on top of the page ). later on in do_upload() func, we send a proper filled array of this name
		// when the user uploads a file and there are errrors.
		$this->load->view('upload_form',array('error'=>'')); // passing in the error array is similar to passing in $data array to the view
															//  -- but this is just one variable so we're loading it on the fly , to the view
	}

	function do_upload(){
		//this will perform the actual upload after a user tries to upload a file.
		$config['upload_path'] = './uploads'; //create an uploads folder in the root folder for this to work.
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '250'; // in kBytes
		$config['max_width'] = '800';
		$config['max_height'] = '800'; 
		$this->load->library('upload', $config);

		if( !$this->upload->do_upload()){
			//if it doesn't upload correctly, then display the errors
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload_form', $error); 
		}
		else{ // otherwise we want to let them know that it uploaded. we show all of he info about the uploaded file
			$data = array('upload_data' => $this->upload->data());
			$this->load->view('upload_success', $data);

		}

	}

}