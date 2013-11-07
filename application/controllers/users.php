<?php

class Users extends CI_Controller{
	// not goign to create an index func here - abbas
	function login(){
		$data['error'] = 0;
		if($_POST){
			$this->load->model('user');
			$username = $this->input->post('username',true); // this is same are $username = $_POST['username'];
			$password = $this->input->post('password',true);
			$type = $this->input->post('user_type',true);
			$user = $this->user->login($username,$password,$type); // using the 'user' Model and its func 'login'
			if(!$user){ // i.e. if no results are returned
				$data['error'] = 1;
			}		
			else{
				//add variable to session to tell every page the user is logged in
				$this->session->set_userdata('userID',$user['userID']);
				$this->session->set_userdata('user_type',$user['user_type']);
				redirect(base_url().'posts'); // reidrect to the 'posts' controller
			}

		}

		// show login form if no _POST was set or login was incorrect .
		$this->load->view('header');
		$this->load->view('login',$data); //show it can display the 'wrong user/pass msg' after failed attempt to login
		$this->load->view('footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'posts');
	}


}