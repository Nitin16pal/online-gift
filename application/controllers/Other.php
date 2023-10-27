<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Other extends CI_Controller
{
    //Validating login
    function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('CommonModel');

    }
    // End Blogs
    public function subscribe()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<span class="invalid-feedback d-block">', '</span>');
        $this->form_validation->set_rules('email', ' Email', 'trim|required|valid_email|is_unique[news_letter.email]');
        $this->form_validation->set_message('is_unique', 'you have already subscribed');

        if ($this->form_validation->run() == true) {
            $userdata['email '] = $this->input->post('email');
            $userdata['created'] = date('Y-m-d H:i:s');

            // send data to model
            $added = $this->UserModel->add_record('news_letter', $userdata);

            if ($added) {
                $success = 'Thankyou for subscribe';
                echo json_encode(['success' => $success]);
            } else {
                $errors = 'Somthing went wrong';
                echo json_encode(['error' => $errors]);
            }
        } else {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        }
    }

    public function contact()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<span class="invalid-feedback d-block">', '</span>');
        $this->form_validation->set_rules('con_name', ' Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('con_email', ' Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('con_subject', ' Subject', 'trim|required');
        $this->form_validation->set_rules('con_message', 'Message', 'trim|required|min_length[3]|max_length[250]');

        if ($this->form_validation->run() == true) {
            $userdata['ct_name'] = $this->input->post('con_name');
            $userdata['ct_email '] = $this->input->post('con_email');
            $userdata['ct_subject'] = $this->input->post('con_subject');
            $userdata['ct_message'] = $this->input->post('con_message');
            $userdata['ct_created'] = date('Y-m-d H:i:s');

            // send data to model

            $added = $this->UserModel->add_record('contact_us', $userdata);
            if ($added) {
                $this->session->set_flashdata('conquery', 'Your query has been submitted successfully. Our team member get in touch soon!');
                redirect(base_url('contact-us'));
            } else {
                $this->session->set_flashdata('conerror', 'Something went wrong. Please try again.');
                redirect('contact-us');
            }
        } else {
            $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/contact',$data);
        }
    }

    public function page_404()
    {
        $this->output->set_status_header('404');
        $this->load->view('error404');
    }

    public function shipping_and_delivery()
    {
            $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/shipping-and-delivery',$data);
    }
    public function refund_and_cancellation()
    {
            $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/refund-and-cancellation',$data);
    }
    public function privacy_and_policy()
    {
            $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/privacy-and-policy',$data);
    }
    public function terms_and_condition()
    {
            $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/terms-and-condition',$data);
    }
    public function about()
    {
        $this->load->view('about');
    }

}
