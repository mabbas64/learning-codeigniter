<?php

class Emails extends CI_Controller{

	function email(){
		$this->load->model('user');
		$emails = $this->user->get_emails();
		//print_r($emails);
		$this->load->library('email');
		$config['mailtype']='html';
		$this->email->initialize($config); // this is need if we want to send out HTML emails, otherwise <strong> etc tags wont work

		foreach($emails as $row){
			if($row['email']){
				//if this specific db row has an email address then send them an email
				$this->email->from('imabbas@outlook.com','M. Abbas Khan');
				$this->email->to($row['email']);
				$this->email->subject('Test Newseltter from CodeIgniter project');
				$this->email->message('Your email text message goes here and <strong> Abbas bold sent this</strong> :)');
				$this->email->send();
				//echo $this->email->print_debugger();
				$this->email->clear(); // make sure to clear this so multiple emails can be sent afterwards
			}
		}

	}
}