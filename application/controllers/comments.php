<?php

class Comments extends CI_Controller{

	function add_comment($postID){

		if(!$_POST){ //if no comment data sent, redirect to same post
			redirect(base_url().'posts/post/'.$postID);
		}

		$user_type = $this->session->userdata('user_type');
		if(!$user_type){ //if no user logged in, redirect to login page, they shudnt comment like this
			redirect(base_url().'users/login');
		}

		//compare captcha word in session VS the captcha from $_POST
		if(strtolower($this->session->userdata('captcha')) != strtolower($_POST['captcha'])){
			echo "<p>The captcha code was incorrect</p><br />";
			echo "<p> You typed ".$_POST['captcha']." and the code was ".$this->session->userdata('captcha')." </p><br />";
		}
		else{
			//save the new comment
			$this->load->model('comment');
			$data = array(
					'postID' => $postID,
					'userID' => $this->session->userdata('userID'),
					'comment' => $_POST['comment']
				);
			$this->comment->add_comment($data); //save the new comment to DB via the comment Model
			redirect(base_url().'posts/post/'.$postID);
		}
	}

}