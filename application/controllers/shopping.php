<?php
class Shopping extends CI_Controller{

	function index(){
		$this->load->helper('form');
		$this->load->library('cart');
		$this->load->view('shopping');
	}

	function update(){
		$this->load->library('cart');
		$this->cart->update($_POST); //we update everything from $_POST
		redirect(base_url().'shopping'); //redir them back to index page which is the 
	}

	function add_variables(){
		//we're going to put in some default products into the session, as we dont havea  complete catalog in this tut.
		$this->load->library('cart');
		$data = array(
					array(
							'id' => 'sku_123ABC',
							'qty' => 1,
							'price' => 39.95,
							'name' => 'T-shirt abbas',
							'options' => array ('Size' => 'L', 'Color' => 'Red')
						),
					array(
							'id' => 'sku_567ZYX',
							'qty' => 1,
							'price' => 9.95,
							'name' => 'Coffee Mug'
						),
					array(
							'id' => 'sku_965QRS',
							'qty' => 1,
							'price' => 29.95,
							'name' => 'Shot Glass'
						)
			);
		$this->cart->insert($data);
	}
}