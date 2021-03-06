<?php

class Posts extends CI_Controller{
	// extending gets us all the classes and funcs that make codeigniter run.
	//-- controller is the middle man. it communicates with the model and then sends everything to the view

	function __construct(){
		parent::__construct();
		$this->load->model('post'); // we have the construct such that, within every func in this class, we're gonna load the post model
	}

	function index($start=0){ //index means when we load the 'posts' controller, we'll go to this func first!
		//grab the posts and display it on browser

		//1- first load the model
		//$this->load->model('post'); 
		# this is no longer needed as we're loading the 'post.php' model in the construct (for all funcs to use)

		//2- create an array data, it'll hold all the variables/data/everything that the view is going to use.
		$data['posts'] =  $this->post->get_posts(5,$start); 
							// we've loaded the model 'post', we're using the post-model and calling its func get_posts()
		//3-print the array temporarily here. access it by doing http://ci.dev/index.php/posts
															//  index.php is the main ci index.php and /posts is our controller
		//echo "<pre>"; 
		//print_r($data['posts']);
		//echo "</pre>";

		//pagination below
		$this->load->library('pagination');
		$config['base_url']= base_url().'posts/index/'; // we save our configuration variables to this config array,
														// we'll then pass this config array when initializing pagination lib
		$config['total_rows']= $this->post->get_posts_count();
		$config['per_page'] = 5;
		$this->pagination->initialize($config); 
		$data['pages'] = $this->pagination->create_links();

		//3b- Load the 'post_index' View here
		$this->load->view('post_index', $data);
	}

	function post($postID){
		//$postID variable will be received from the _GET variable, which in CI doesnt have ?id= , but rater  post/id/. prettied up with slashes.
		//load comment model so we can fetch all comments
		$this->load->model('comment');
		$data['comments'] = $this->comment->get_comments($postID);
		$data['post']= $this->post->get_post($postID);

		//captcha
		$this->load->helper('captcha');
		$vals = array(
				'img_path' => './captcha/',
				'img_url' => base_url().'captcha/',
				'width' => 150,
				'height' => 30
			);

		$cap = create_captcha($vals);
		$this->session->set_userdata('captcha', $cap['word']); //the word that captcha will display. we need to save it in session for comparing later on
		$data['captcha'] = $cap['image']; //the actual image, we'll display on page

		$this->load->helper('smiley');
		$this->load->library('table');

		$image_array = get_clickable_smileys(base_url().'smileys/','comment'); // (location of smileys, #id of element we want to attach smileys to)
		$col_array = $this->table->make_columns($image_array, 8); //we want 8 smileys per row. The table library will sort it us for us auto :)
		$data['smiley_table'] = $this->table->generate($col_array);

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('post',$data); // pass it on the single-posts' data that we got from get_post() func of 'post' Model in previous line
	}

	function new_post(){
		//this new post data will come from a form, via _POST
		$user_type = $this->session->userdata('user_type');
		if($user_type != "admin" && $user_type != "author")
			redirect(base_url().'users/login'); //only admin and author types can add new posts

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

	function correct_permissions($required){
		//returns whether the current logged in user has the right permissions to perform the specific task
		$user_type = $this->session->userdata('user_type');
		if($required=="user"){
			if($user_type){ // lowest type of user, so any user , if logged in, qualifies
				return true;
			}
		}
		else if($required=="author"){
			if($user_type == "admin" || $user_type == "author"){ //an author can edit, but admin is higher level so he also qualifies
				return true;
			}
		}
		else if($required=="admin"){
			if($user_type=="admin"){
				return true;
			}
		}
	}

	function edit_post($postID){
		if(!$this->correct_permissions('author'))
			redirect(base_url().'users/login'); //only admin and author types can edit posts

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
		$user_type = $this->session->userdata('user_type');
		if($user_type != "admin" && $user_type != "author") // can also replace this user permission check with the same code as that in edit_post func
			redirect(base_url().'users/login'); //only admin and author types can delete posts

		$this->post->delete_post($postID);
		redirect(base_url());
	}
}