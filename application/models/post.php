<?php
class Post extends CI_Model{
	// extending here means this model is going to share all the classes and functions that CI_Model has

	function get_posts($num=20,$start=0){
		//we want this func to connect with db and select everything from 'posts' table
		//  grab the results and return it
		// -- we want to take advantage of the DB library that we're autoloading

		$this->db->select()->from('posts')->where('active',1)->order_by('date_added','desc')->limit($num,$start);
		// $this class -> then the DB library -> from 'posts' db table -> where active==1 in table -> order by descending order

		/*$this->db->select('*');
		$this->db->from('posts');
		$this->db->where('active',1);
		$this->db->where(array('active'=>1)); # this is the same as line above it, it just allows more conditions in array
		$this->db->order_by('date_added','desc');
		$this->db->limit($num,$start);
		// For Joining, we can do
		$this->db->join('users','users.userID=posts.userID','left');
		//alternatively, we can run a query by this also
		$query=$this->db->get_where('posts'array('active'=>1),$num,$start);*/

		# EVERYTHIG ABOVE THIS POINT IS JUST PREPARING THE QUERY. THE QUERY WILL ONLY RUN AFTER THE FOLLOWING Line		
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_post($postID){
		$this->db->select()->from('posts')->where(array('active'=>1,'postID'=>$postID))->order_by('date_added','desc');
		$query = $this->db->get();
		return $query->first_row('array'); // if we dont specify 'array' for first_row, it'll return it as an object.

	}

	function insert_post($data){
		//will insert a new post in 'posts' table.
		/*$data = array(
				'title' => 'this is a test post yeah',
				'description' => ' this is a description of test post'
			)*/
		$this->db->insert('posts',$data);
		return $this->db->insert_id();
	}

	function update_post($postID,$data){
		$this->db->where('postID',$postID); //this is our selector, based on postID
		$this->db->update('posts',$data); //now we update the specific blogpost data
	}

	function delete_post($postID){
		$this->db->where('postID',$postID);
		$this->db->delete('posts'); // this wont delete the entire table as long as we use the WHERE SELECTOR above it.

	}
	function query(){
		#you can type out the query urself if you dont want to use Active Record. And in fact, its a little bit faster if you type
		## out the query, instead of using active record
		$query = $this->db->query("SELECT * FROM posts WHERE active=1 ORDER BY date_added desc LIMIT $num,$start");
	}


}