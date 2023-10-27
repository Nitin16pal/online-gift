<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
    //Validating login
    function __construct()
    {
        parent::__construct();
        $this->load->model('CommonModel');
        $this->load->model('UserModel');
        $this->load->model('CartModel');
        $this->load->library('cart');
    }

    //  User Section Start

    public function userlogin()
    {
        $this->load->helper(array('form', 'common_helper'));
        $this->load->library('form_validation');

        if ($this->input->post('btntype') == 'login') {
            $this->form_validation->set_rules('useremail', 'User Name', 'trim|required|valid_email');
            $this->form_validation->set_rules('userpassword', 'User Email', 'trim|required');
            if ($this->form_validation->run() == true) {
                $useremail = $this->input->post('useremail');
                $userpassword = $this->input->post('userpassword');

                $valid = $this->UserModel->userlogin('user_registration', array('ur_email' => $useremail, 'ur_passward' => $userpassword));

                if (isset($valid['0'])) {
                    $status = $valid['0']->ur_status;
                    $uname = $valid['0']->ur_name;
                    $ur_email = $valid['0']->ur_email;
                    $ur_mobile = $valid['0']->ur_mobile;
                    $ur_id = $valid['0']->ur_id;
                    if ($status == 1) {
                        $this->session->set_userdata('enduser', $uname);
                        $this->session->set_userdata('uremails', $ur_email);
                        $this->session->set_userdata('urids', $ur_id);
                        $this->session->set_userdata('ur_mobile', $ur_mobile);
                        // $this->session->set_userdata('uremails ', $ur_email);

                        // Add Product to cart when in  session 


                        $cart = $this->cart->contents();
                        if (!empty($cart)) {
                            foreach ($cart as $clist) {
                                $cartdata['user_id'] = $ur_id;
                                $cartdata['pd_id'] = $clist['id'];
                                $cartdata['pd_name'] = $clist['name'];
                                $cartdata['pd_price'] = $clist['price'];
                                $cartdata['pd_quantity'] = $clist['qty'];
                                $cartdata['pd_total'] = $clist['qty'] * $clist['price'];
                                $cartdata['pd_created'] = date('Y-m-d H:i:s');
                                // send data to model
                                $added = $this->CartModel->add_record('carts', $cartdata);

                                $data = array(
                                    'rowid' => $clist['rowid'],
                                    'qty' => 0,
                                );
                                $this->cart->update($data);
                            }
                        }

                        $success = 'Your are now logged in';
                        echo json_encode(['success' => $success]);
                    } else {
                        $errors = 'Your account deactivated';
                        echo json_encode(['error' => $errors]);
                    }
                } else {
                    $errors = 'Please enter valid login details';
                    echo json_encode(['error' => $errors]);
                }
            } else {
                $errors = validation_errors();
                echo json_encode(['error' => $errors]);
            }
        } else if ($this->input->post('btntype') == 'subscribe') {

            $this->form_validation->set_rules('subsemail', 'Email', 'trim|required|valid_email|is_unique[news_letter.email]');
            $this->form_validation->set_message('is_unique', 'You have already subscribed');
            if ($this->form_validation->run() == true) {
                $subsemail = $this->input->post('subsemail');

                $added = $this->UserModel->add_record('news_letter', array('email' => $subsemail, 'created' => date('Y-m-d H:i:s')));
                if ($added) {
                    echo json_encode(['success' => 'True', 'message' => 'You have subscribe successfully']);
                } else {
                    echo json_encode(['error' => 'Something went wrong in server! Please try again after some time']);
                }
            } else {
                $errors = validation_errors();
                echo json_encode(['error' => $errors]);
            }
        } else if ($this->input->post('btntype') == 'forgetpass') {
            $this->form_validation->set_rules('fgemail', 'Register Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == true) {
                $fgemail = $this->input->post('fgemail');
                $valid = $this->UserModel->userlogin('user_registration', array('ur_email' => $fgemail));
                if (isset($valid['0'])) {
                    $status = $valid['0']->ur_status;
                    $uname = $valid['0']->ur_name;
                    $ur_email = $valid['0']->ur_email;
                    $ur_mobile = $valid['0']->ur_mobile;
                    $ur_id = $valid['0']->ur_id;
                    if ($status == 1) {
                        $usrpassword = generateRandomString();

                        $added = $this->UserModel->update_record('user_registration', array('ur_passward' => $usrpassword), array('ur_email' => $fgemail));
                        if ($added) {
                            $response = "
                        <html lang='en' xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office'>

                        <head>
                            <meta charset='utf-8'>
                            <meta name='viewport' content='width=device-width,initial-scale=1'>
                            <meta name='x-apple-disable-message-reformatting'>
                            <title>Change Password Mail Response</title>
                        </head>

                        <body style='margin:0;padding:0;word-spacing:normal;background-color:#ffffff;'>
                            <div role='article' aria-roledescription='email' lang='en'
                                style='text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#ffffff;color:#666;text-align:left;margin-left:20px;font-size:16px;font-family:Arial,sans-serif;line-height:15px;'>
                                <p>Dear $uname,</p><br>
                                <p>Greetings! </p><br>
                                <p>Your password has been changeed and your password id <b>: $usrpassword.</b></p>
                            </div>
                        </body>

                        </html>";
                            $headers = 'MIME-Version: 1.0' . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers .= 'From:  info@printviu.in' . "\n";
                            $subject = "Printviu Response";
                            $send = mail($fgemail, $subject, $response, $headers);
                            if ($send) {
                                echo json_encode(['success' => 'Password has been sent on your mail.']);
                            } else {
                                echo json_encode(['error' => 'Something went wrong! Please try again.']);
                            }
                        } else {
                            echo json_encode(['error' => 'Something went wrong! Please try again.']);
                        }
                    } else {
                        $errors = 'Your account is deactivated';
                        echo json_encode(['error' => $errors]);
                    }
                } else {
                    echo json_encode(['error' => 'Please enter register email']);
                }
            } else {
                echo json_encode(['error' => validation_errors()]);
            }
        }
    }
    public function user_regstration()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<span class="invalid-feedback d-block">', '</span>');
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('useremail', 'User Email', 'trim|required|valid_email|is_unique[user_registration.ur_email]');
        $this->form_validation->set_rules('usermobile', 'User Mobile', 'trim|required|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('userstreet1', 'Address', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('userpass', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[userpass]');
        $this->form_validation->set_message('is_unique', 'This Email Already Registerd');

        if ($this->form_validation->run() == true) {
            $userdata['ur_name'] = $this->input->post('username');
            $userdata['ur_email '] = $this->input->post('useremail');
            $userdata['ur_mobile'] = $this->input->post('usermobile');
            $userdata['ur_address'] = $this->input->post('userstreet1');
            $userdata['ur_passward'] = $this->input->post('userpass');
            $userdata['ur_created'] = date('Y-m-d H:i:s');

            // send data to model
            $added = $this->UserModel->add_record('user_registration', $userdata);
            if ($added) {
                $this->session->set_flashdata('usrregister', 'Registration successfull, Now you can login.');
                redirect(base_url());
            } else {
                $this->session->set_flashdata('usrerror', 'Something went wrong. Please try again.');
                redirect('signup');
            }
        } else {
            $prd['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
            $this->load->view('public/signup', $prd);
        }
    }

    public function checkout()
    {
        $urids = $this->session->userdata('urids');
        if ($urids) {
            $data['userd'] = $this->UserModel->userlogin('user_registration', array('ur_id' => $urids));
        }
        $data['cat_list'] = $this->CommonModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
        $this->load->view('public/checkout', $data);
    }

    public function order_history()
    {
        $urids = $this->session->userdata('urids');

        $data['odhist'] = $this->CartModel->fetch_record('orders', array('od_user_id' => $urids), 'od_id', 'DESC');
        $data['cat_list'] = $this->CartModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
        $this->load->view('public/order-history', $data);
    }
    public function order_details($orderid)
    {
        $crtdetails = $this->CartModel->fetch_record('products_order', array('po_product_order' => $orderid), 'po_created', 'ASC');
        $count = 1;
        $glhomeimage = '';
        if (isset($crtdetails[0])) {
            foreach ($crtdetails as $clist) {
                $prod_id = $clist['po_prd_id'];

                $gatgall = $this->db->query("SELECT * FROM `product_gallery` WHERE `pg_home`='1' AND `pg_prod`='$prod_id' AND `pg_status`='1'");
                foreach ($gatgall->result() as $glrow) {
                    $glhomeimage = $glrow->pg_name;
                }
?>
                <tr class="cell-1">
                    <td><?= $count++; ?></td>
                    <td class="float-left"><img src="https://www.printviu.in/upload/products/<?= $glhomeimage; ?>" alt="<?= $clist['po_prd_name']; ?>" style="width: 50px;"></td>
                    <!-- <td><?= $clist['po_prd_id'] ?></td> -->
                    <td><?= $clist['po_prd_name'] ?></td>
                    <td><?= $clist['po_prd_price'] ?></td>
                    <td><?= $clist['po_prd_quantity'] ?></td>
                    <td><?= $clist['po_prd_total'] ?></td>
                    <td> <?= date("F j, Y", strtotime($clist['po_created'])); ?></td>
                </tr>
<?php }
        }
    }

    public function update_address()
    {
        $this->load->helper(array('form'));
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<span class="invalid-feedback d-block">', '</span>');
        $this->form_validation->set_rules('user_name', 'User Name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('user_mail', 'User Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('user_number', 'User Mobile', 'trim|required|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('add1', 'Address', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('city', 'Address', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('state', 'Address', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('zip', 'Password', 'trim|required|min_length[6]|max_length[6]');

        if ($this->form_validation->run() == true) {
            $userdata['ur_name'] = $this->input->post('user_name');
            $userdata['ur_email '] = $this->input->post('user_mail');
            $userdata['ur_mobile'] = $this->input->post('user_number');
            $userdata['ur_address'] = $this->input->post('add1');
            $userdata['ur_address2'] = $this->input->post('add2');
            $userdata['ur_city'] = $this->input->post('city');
            $userdata['ur_state'] = $this->input->post('state');
            $userdata['ur_country'] = "India";
            $userdata['ur_pin'] = $this->input->post('zip');
            $userdata['ur_addr_type'] = $this->input->post('addrtype');
            $userdata['ur_created'] = date('Y-m-d H:i:s');

            $urids = $this->session->userdata('urids');
            // send data to model
            $added = $this->UserModel->update_record('user_registration', $userdata, array('ur_id' => $urids));
            if ($added) {
                $success = 'success';
                echo json_encode(['success' => $success, 'up_user_id' => $urids, 'payment_type' => "QR Code", 'payment_id' => "NIT125pal", 'pay_order_id' => "EC125478"]);
            } else {
                $errors = 'Something went wrong. Please try again.';
                echo json_encode(['error' => $errors]);
            }
        } else {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        }
    }
    public function place_orders()
    {
        $urids = $this->session->userdata('urids');
        $this->load->helper(array('form', 'common_helper'));
        $this->load->library('form_validation');
        $paystatus = $this->input->post('paystatus');
        $pay_ur_id = $this->input->post('pay_ur_id');
        $pay_odr_id = $this->input->post('pay_odr_id');
        $pay_type = $this->input->post('pay_type');

        $this->form_validation->set_error_delimiters('<span class="invalid-feedback d-block">', '</span>');
        $this->form_validation->set_rules('paystatus', 'Payment Status', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('pay_ur_id', 'User Id', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('pay_type', 'Payment Type', 'trim|alpha_numeric_spaces');
        $this->form_validation->set_rules('pay_id', 'Payment Id', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('pay_odr_id', 'Payment Order Id', 'trim|required|alpha_numeric_spaces');

        if ($this->form_validation->run() == true) {
            $paystatus = $this->input->post('paystatus');
            $pay_ur_id = $this->input->post('pay_ur_id');
            $pay_type = $this->input->post('pay_type');
            $pay_id = $this->input->post('pay_id');
            $pay_odr_id = $this->input->post('pay_odr_id');
            $grandtotal = $this->input->post('grandtotal');
            $subtotal = $this->input->post('subtotal');
            $shipcarg = $this->input->post('shipcarg');
            $grtotal = $this->input->post('grtotal');
            $urids = $this->session->userdata('urids');
            if ($urids) {
                $urdetails = $this->UserModel->userlogin('user_registration', array('ur_id' => $urids));
            }
            $ordpoduct['od_total_price'] = $grtotal;
            $ordpoduct['od_ship_charge'] = $shipcarg;
            $ordpoduct['od_sub_total'] = $grandtotal;
            $ordpoduct['od_tax'] = '18';
            $ordpoduct['od_paystatus'] = $paystatus;
            $ordpoduct['od_pay_ur_id'] = $pay_ur_id;
            $ordpoduct['od_pay_type'] = $pay_type;
            $ordpoduct['od_pay_id'] = $pay_id;

            $ordpoduct['od_user_id'] = $urdetails[0]->ur_id;
            $ordpoduct['od_hs_id '] = mt_rand(1000, 10000) . generateRandomString();
            $ordpoduct['od_address'] = $urdetails[0]->ur_address;
            $ordpoduct['od_address2'] = $urdetails[0]->ur_address2;
            $ordpoduct['od_city'] = $urdetails[0]->ur_city;
            $ordpoduct['od_state'] = $urdetails[0]->ur_state;
            $ordpoduct['od_country'] = $urdetails[0]->ur_country;
            $ordpoduct['od_zip_code'] = $urdetails[0]->ur_pin;
            $ordpoduct['od_add_type'] = $urdetails[0]->ur_addr_type;
            $ordpoduct['od_created'] = date('Y-m-d H:i:s');

            // send data to model
            $ordid = $this->UserModel->placeorder('orders', $ordpoduct);
            if (!empty($ordid)) {

                $crtdetails = $this->CartModel->fetch_record('carts', array('user_id' => $urids), 'pd_created', 'ASC');

                if (isset($crtdetails[0])) {
                    foreach ($crtdetails as $clist) {
                        $crtords['po_product_order'] = $ordid;
                        $crtords['po_user_id'] = $urids;
                        $crtords['po_prd_id'] = $clist['pd_id'];
                        $crtords['po_prd_name'] = $clist['pd_name'];
                        $crtords['po_prd_price'] = $clist['pd_price'];
                        $crtords['po_prd_quantity'] = $clist['pd_quantity'];
                        $crtords['po_prd_total'] = $clist['pd_total'];
                        $crtords['po_created'] = date('Y-m-d H:i:s');
                        $placeord = $this->UserModel->placeorder('products_order', $crtords);
                    }
                    if ($placeord) {
                        $deleteCart = $this->CartModel->delete_data('carts', array('user_id' => $urids));
                        if ($deleteCart) {
                            $success = 'success';
                            echo json_encode(['success' => $success, 'orderid' => $placeord]);
                        } else {
                            $errors = 'Something went wrong. Please try again. at the time cart delete';
                            echo json_encode(['error' => $errors]);
                        }
                    } else {
                        $errors = 'Something went wrong. Please try again. at the time of cart move to product order';
                        echo json_encode(['error' => $errors]);
                    }
                } else {
                    $errors = 'Something went wrong. Please try again. at the time of cart data.';
                    echo json_encode(['error' => $errors]);
                }
            } else {
                $errors = 'Something went wrong. Please try again. at the time of Order';
                echo json_encode(['error' => $errors]);
            }
        } else {
            $errors = validation_errors();
            echo json_encode(['error' => $errors]);
        }
    }

    // Order Cancel

    public function order_cancel($orderid)
    {
        if (!empty($orderid)) {
            $odstatus['od_status'] = 'cancel';
            $odhist['oh_order_status'] = 'cancel';
            $odhist['oh_order_comment'] = 'Cancel by user';
            $odhist['oh_order_id'] = $orderid;
            $odhist['oh_date_added'] = date('Y-m-d H:i:s');
            $odht = $this->UserModel->add_record('order_history', $odhist);
            $odst = $this->UserModel->update_record('orders', $odstatus, array('od_id' => $orderid));
            if ($odht) {
                echo json_encode(array('status' => 'success', 'message' => 'Your oder cancel successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Something went wrong in server side please try again'));
            }
        }
    }


    //  Logout 
    function userlogout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {

            if ($key != 'enduser' && $key != 'userstatus' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect(base_url());
    }
    // End User Section
}
