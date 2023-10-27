<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CommonModel');
	}
	public function index()
	{
		$prd['feature_products'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_feature' => '1'), 'prod_id', 'DESC', '8');
		$prd['recent_products'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_recent' => '1'), 'prod_id', 'DESC', '8');
		$prd['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
		$this->load->view('public/index', $prd);
	}

	public function products($cate_url, $subcaturl = '')
	{

		$catid = '';
		$subcatid = '';
		if (!empty($cate_url) && !empty($subcaturl)) {
			$catgory = $this->CommonModel->fetch_single_record('category', array('cat_status' => '1', 'cat_url' => $cate_url));
			$sub_catgory = $this->CommonModel->fetch_single_record('sub_category', array('sub_cat_status' => '1', 'sub_cat_url' => $subcaturl));
			if (!empty($catgory)) {
				$catid = $catgory[0]['cat_id'];
			}
			if (!empty($sub_catgory)) {
				$subcatid = $sub_catgory[0]['sub_cat_id'];
			}
			if (empty($catid) || empty($subcatid)) {
				redirect('/');
			}
			$prd['catproducts'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_sub_cat' => $subcatid), 'prod_id', 'DESC');
		} else if (!empty($cate_url)) {
			$catgory = $this->CommonModel->fetch_single_record('category', array('cat_status' => '1', 'cat_url' => $cate_url));

			if (!empty($catgory)) {
				$catid = $catgory[0]['cat_id'];
			}
			if (empty($catgory)) {
				redirect('/');
			}
			$prd['catproducts'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid), 'prod_id', 'DESC');
		} else {
			redirect('/');
		}
		// print_r($this->db->last_query());
		// exit;
		$prd['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
		$this->load->view('public/products', $prd);
	}

	public function products_details($cate_url, $subcaturl, $produrl = '')
	{

		$catid = '';
		$subcatid = '';

		if (!empty($cate_url) && !empty($subcaturl) && !empty($produrl)) {

			$catgory = $this->CommonModel->fetch_single_record('category', array('cat_status' => '1', 'cat_url' => $cate_url));
			$sub_catgory = $this->CommonModel->fetch_single_record('sub_category', array('sub_cat_status' => '1', 'sub_cat_url' => $subcaturl));
			if (!empty($catgory)) {
				$catid = $catgory[0]['cat_id'];
			}
			if (!empty($sub_catgory)) {
				$subcatid = $sub_catgory[0]['sub_cat_id'];
			}
			if (empty($catid) || empty($subcatid)) {
				redirect('/');
			}
			$prd['prductsdetails'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_sub_cat' => $subcatid, 'prod_url' => $produrl), 'prod_id', 'DESC');
			$prd['sprod'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_sub_cat' => $subcatid), 'prod_id', 'DESC');
		} else if (!empty($cate_url) && !empty($subcaturl)) {
			$catgory = $this->CommonModel->fetch_single_record('category', array('cat_status' => '1', 'cat_url' => $cate_url));
			if (!empty($catgory)) {
				$catid = $catgory[0]['cat_id'];
			}
			if (empty($catid)) {
				redirect('/');
			}
			$prd['prductsdetails'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_sub_cat' => $subcatid, 'prod_url' => $subcaturl), 'prod_id', 'DESC');
			$prd['sprod'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_sub_cat' => $subcatid), 'prod_id', 'DESC');
		} else if (!empty($cate_url)) {
			$catgory = $this->CommonModel->fetch_single_record('category', array('cat_status' => '1', 'cat_url' => $cate_url));

			if (!empty($catgory)) {
				$catid = $catgory[0]['cat_id'];
			}
			if (empty($catgory)) {
				redirect('/');
			}

			$prd['prductsdetails'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid, 'prod_url' => $subcaturl), 'prod_id', 'DESC');
			$prd['sprod'] = $this->CommonModel->fetch_record('products', array('prod_status' => '1', 'prod_cat' => $catid), 'prod_id', 'DESC');
		} else {
			redirect('/');
		}

		$prd['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
		$this->load->view('public/detail', $prd);
	}

	public function products_search()
	{
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$product_name = $this->input->post('product_name');
			if (!empty($product_name)) {

				$data['plist'] = $this->CommonModel->fetch_lrecord('products', array('prod_status' => '1', 'prod_details' => $product_name, 'prod_name' => $product_name), 'prod_name', 'ASC');

				$clist = $this->CommonModel->fetch_lrecord('category', array('cat_status' => '1', 'cat_desc' => $product_name, 'cat_name' => $product_name), 'cat_name', 'ASC');
				if (isset($clist[0])) {
					$catid = $clist[0]['cat_id'];
					$data['cplist'] = $this->CommonModel->fetch_lrecord('products', array('prod_status' => '1', 'prod_cat' => $catid), 'prod_name', 'ASC');
				}

				$sclist = $this->CommonModel->fetch_lrecord('sub_category', array('sub_cat_status' => '1', 'sub_cat_desc' => $product_name, 'sub_cat_name' => $product_name), 'sub_cat_name', 'ASC');
				if (isset($sclist[0])) {
					$catid = $sclist[0]['sub_cat_id'];
					$data['scplist'] = $this->CommonModel->fetch_lrecord('products', array('prod_status' => '1', 'prod_cat' => $catid), 'prod_name', 'ASC');
				}
			}
		}

		$data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
		$this->load->view('public/search', $data);
	}
}
