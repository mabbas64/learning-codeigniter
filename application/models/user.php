<?php

class User extends CI_Model{

	function create_user($data){
		$this->db->insert('users',$data);
		#todo, this must reutn userID, NOT the username! for the session. needs to fix! abbas
		return $data['username']; //return this so we can creat a session for the newly registered user and log him in automatically
	}

	function login($username,$password,$type){
		$where = array(
				'username' => $username,
				'password' => sha1($password),
				'user_type' => $type
			);
		$this->db->select()->from('users')->where($where);
		$query = $this->db->get();
		return $query->first_row('array'); //return the result as an array
	}
}