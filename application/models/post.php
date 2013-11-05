<?php
class Post extends CI_Model{
	// extending here means this model is going to share all the classes and functions that CI_Modelhas

	function get_posts($num=20,$start=0){
		//we want this func to connect with db and select everything from 'posts' table
		//  grab the results and return it
		// -- we want to take advantage of the DB library that we're autoloading

		$this->db->select()->from('posts')->where('active',1)->order_by('date_added','desc')->limit($num,$start);
		// $this class -> then the DB library -> from 'posts' db table -> where active==1 in table -> order by descending order
		$query = $this->db->get();
		return $query->result_array();
	}

}