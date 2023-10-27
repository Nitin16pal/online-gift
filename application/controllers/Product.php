<?php
class Product extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// if (!$this->session->userdata('enduserid'))
		// redirect(base_url());
		$this->load->model('CartModel');
	}

	public function cart()
	{
		$userid = $this->session->userdata('enduserid');
		$udata['cartdata'] = $this->CartModel->checkcart('user_id', $userid, 'cart');
		$this->load->view('cart', $udata);
	}

	public function checkout()
	{
		$this->load->view('checkout');
	}
	
	function add_to_cart()
	{
		$userid = $this->session->userdata('enduserid');
		$qty = $this->input->post('quantity');
		$price = $this->input->post('product_price');
		$subtotal = $qty * $price;
		$pd_id = $this->input->post('product_id');
		$udata['user_id'] = $userid;
		$udata['pd_id'] = $pd_id;
		$udata['pd_name'] = $this->input->post('product_name');
		$udata['pd_price'] = $price;
		$udata['pd_quantity'] = $qty;
		$udata['pd_total'] = $subtotal;
		$formArray['pd_created'] = date('Y-m-d H:i:s');

		$checkn = $this->CartModel->checkcart('user_id', $userid, 'cart', 'pd_id', $pd_id);
		if (isset($checkn[0])) {
			$updata['pd_quantity'] = $checkn[0]->pd_quantity + 1;
			$checkn = $this->CartModel->updatecart('crt_id', $checkn[0]->crt_id, $updata, 'cart');
		} else {
			$this->CartModel->adddata('cart', $udata);
		}
	}

	function updatecart()
	{
		$userid = $this->session->userdata('enduserid');

		$qty = $this->input->post('quantity');
		$price = $this->input->post('price');
		$pd_id = $this->input->post('product_id');
		$crt_id = $this->input->post('crt_id');

		$subtotal = $qty * $price;

		$udata['pd_quantity'] = $qty;
		$udata['pd_total'] = $subtotal;

		if (!empty($userid)) {
			$checkn = $this->CartModel->checkcart('user_id', $userid, 'cart', 'pd_id', $pd_id);
			if (isset($checkn[0])) {
				$checkn = $this->CartModel->updatecart('crt_id', $crt_id, $udata, 'cart', 'user_id', $$userid);
			}
		}
	}

	function cartqtty()
	{
		$userid = $this->session->userdata('enduserid');
		if (!empty($userid)) {
			$cartdata = $this->CartModel->countproduct('cart', 'user_id', $userid);
			echo $cartdata;
		}
	}

	function delete_cart($table, $colid, $id, $userid, $uid)
	{
		$this->CartModel->delete_data($table, $colid, $id, $userid, $uid);
	}
}
