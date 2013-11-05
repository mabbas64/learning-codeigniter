<?php

class Posts extends CI_Controller{
	// extending gets us all the classes and funcs that make codeigniter run.
	//-- controller is the middle man. it communicates with the model and then sends everything to the view

	function index(){ //index means when we load the 'posts' controller, we'll go to this func first!
		//grab the posts and display it on browser

		//1- first load the model
		$this->load->model('post');

		//2- create an array data, it'll hold all the variables/data/everything that the view is going to use.
		$data['posts'] =  $this->post->get_posts(); 
							// we've loaded the model 'post', we're using the post-model and calling its func get_posts()
		//3-print the array temporarily here. access it by doing http://ci.dev/index.php/posts
															//  index.php is the main ci index.php and /posts is our controller
		echo "<pre>"; 
		print_r($data['posts']);
		echo "</pre>";

		//3b- Load the 'post_index' View here
		$this->load->view('post_index', $data);

	}
}