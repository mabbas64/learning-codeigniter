<?php

class Posts extends CI_Controller{
	// extending gets us all the classes and funcs that make codeigniter run.
	//-- controller is the middle man. it communicates with the model and then sends everything to the view

	function __construct(){
		parent::__construct();
		$this->load->model('post'); // we have the construct, such that within every func in this class, we're gonna load the post model
	}

	function index(){ //index means when we load the 'posts' controller, we'll go to this func first!
		//grab the posts and display it on browser

		//1- first load the model
		//$this->load->model('post'); 
		# this is no longer needed as we're loading the 'post.php' model in the construct (for all funcs to use)

		//2- create an array data, it'll hold all the variables/data/everything that the view is going to use.
		$data['posts'] =  $this->post->get_posts(); 
							// we've loaded the model 'post', we're using the post-model and calling its func get_posts()
		//3-print the array temporarily here. access it by doing http://ci.dev/index.php/posts
															//  index.php is the main ci index.php and /posts is our controller
		//echo "<pre>"; 
		//print_r($data['posts']);
		//echo "</pre>";
		//3b- Load the 'post_index' View here
		$this->load->view('post_index', $data);
	}

	function post($postID){
		//$postID variable will be received from the _GET variable, which in CI doesnt have ?id= , but rater  post/id/. prettied up with slashes.
		$data['post']= $this->post->get_post($postID);
		$this->load->view('post',$data); // pass it on the single-posts' data that we got from get_post() DB model in previous line
	}

	function new_post(){
		//this new post data will come from a form, via _POST
		if($_POST){
			$data = array(
					'title' => $_POST['title'],
					'post' => $_POST['post'],
					'active' => 1
				);
			$this->post->insert_post($data);
			redirect(base_url().'posts/'); //redirect them to homepage so they can see the newly added post
		}
		else{ //if no data is received, just show them the new-post page that has the form.
			$this->load->view('new_post');
		}
	}

	function edit_post($postID){
		$data['success'] = 0;
		if($_POST){
			$data_post = array(
					'title' => $_POST['title'],
					'post' => $_POST['post'],
					'active' => 1
				);
			$this->post->update_post($postID,$data_post);
			$data['success'] = 1;			
		}
		$data['post'] = $this->post->get_post($postID);
		$this->load->view('edit_post',$data); //show the form with the values form DB
	}

	function delete_post($postID){
		$this->post->delete_post($postID);
		redirect(base_url());
	}
}