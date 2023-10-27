<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cart extends CI_Controller
{
    //Validating login
    function __construct()
    {
        parent::__construct();

        $this->load->model('CartModel');
    }
    public function wishlist()
    {
        $this->load->view('public/wishlist');
    }


    public function cart()
    {
        $this->load->helper('text');
        $urids = $this->session->userdata('urids');
        $prd['usercarts'] = $this->CartModel->fetch_record('carts', array('user_id' => $urids), 'pd_created', 'DESC');
        $prd['cat_list'] = $this->CartModel->fetch_record('category', array('cat_status' => '1'), 'cat_name', 'ASC');
        $this->load->view('public/cart', $prd);
    }

    public function countcart() // Count Cart Item
    {
        $urids = $this->session->userdata('urids');
        if (!empty($urids)) {
            $countproducts = $this->CartModel->countproduct('carts', array('user_id' => $urids));
            if (!empty($countproducts)) {
                echo $countproducts;
            } else {
                echo 0;
            }
        } else {
            $rows = count($this->cart->contents());
            if (!empty($rows)) {
                echo $rows;
            } else {
                echo 0;
            }
        }
    }

    public function addcart($productId, $userId = '') // Add To Cart
    {
        if (!$this->session->userdata('enduser')) {

            $prodectdet = $this->CartModel->fetch_record('products', array('prod_status' => '1', 'prod_id' => $productId), 'prod_id', 'DESC');
            if (isset($prodectdet['0'])) {
                $data = array(
                    'id'      => $productId,
                    'qty'     => 1,
                    'price'   => $prodectdet['0']['prod_discounted_price'],
                    'name'    => $prodectdet['0']['prod_name'],
                );

                $added = $this->cart->insert($data);
                if ($added) {
                    echo $this->countcart();
                }
            }
        } else {
            $prodectdet = $this->CartModel->fetch_record('products', array('prod_status' => '1', 'prod_id' => $productId), 'prod_id', 'DESC');
            $checkcart = $this->CartModel->fetch_record('carts', array('pd_id' => $productId), 'crt_id', 'DESC');

            if (isset($checkcart['0'])) {
                $cartid = $checkcart['0']['crt_id'];
                $prodprice = $checkcart['0']['pd_price'];
                $cartqty = $checkcart['0']['pd_quantity'] + 1;
                $cartdata['pd_quantity'] = $cartqty;
                $cartdata['pd_total'] = $cartqty * $prodprice;
                // send data to model
                $added = $this->CartModel->updatecart(array('crt_id' => $cartid), $cartdata, 'carts');
                if ($added) {
                    echo $this->countcart();
                }
            } else {
                if (isset($prodectdet['0'])) {
                    $cartdata['user_id'] = $userId;
                    $cartdata['pd_id'] = $productId;
                    $cartdata['pd_name'] = $prodectdet['0']['prod_name'];
                    $cartdata['pd_price'] = $prodectdet['0']['prod_discounted_price'];
                    $cartdata['pd_quantity'] = '1';
                    $cartdata['pd_total'] = $prodectdet['0']['prod_discounted_price'];
                    $cartdata['pd_created'] = date('Y-m-d H:i:s');
                    // send data to model
                    $added = $this->CartModel->add_record('carts', $cartdata);
                    if ($added) {
                        echo $this->countcart();
                    }
                }
            }
        }
    }

    public function deletecart($cartId) // Delete To cart
    {
        if (!empty($cartId)) {
            $checkuser = $this->session->userdata('enduser');
            $urids = $this->session->userdata('urids');

            if (empty($checkuser)) {
                $data = array(
                    'rowid' => $cartId,
                    'qty' => 0,
                );
                $updata = $this->cart->update($data);
                if ($updata) {
                    $subtotal = $this->cart->total();
                    $shippingcharge = ($subtotal < 500) ? 40 : 0;
                    $grandtotal = $subtotal + $shippingcharge;
                    $this->session->set_userdata('subtotal', $subtotal);
                    $this->session->set_userdata('grandtotal', $grandtotal);
                    $this->session->set_userdata('shipcarg', $shippingcharge);
                    // $ccart= ;
                    echo json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong'));
                }
            } else {

                // send data to model
                $added = $this->CartModel->delete_data('carts', array('crt_id' => $cartId));

                $cartlist = $this->CartModel->fetch_record('carts', array('user_id' => $urids), 'pd_created', 'DESC');

                if ($added) {
                    $subtotal = 0;
                    foreach ($cartlist as $clist) {
                        $subtotal = $subtotal + $clist['pd_total'];
                    }
                    $shippingcharge = ($subtotal < 500) ? 40 : 0;
                    $grandtotal = $subtotal + $shippingcharge;
                    $this->session->set_userdata('subtotal', $subtotal);
                    $this->session->set_userdata('grandtotal', $grandtotal);
                    $this->session->set_userdata('shipcarg', $shippingcharge);
                    // $ccart= ;
                    echo json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong'));
                }
            }
        }
    }

    public function updatecart($cartId, $prodqty, $prodprice) // Uppdate Cart To Cart
    {
        if (!$this->session->userdata('enduser')) {
            $data = array(
                'rowid' => $cartId,
                'qty' => $prodqty,
            );
            $added = $this->cart->update($data);
            if ($added) {
                echo $this->countcart();
            }
        } else {
            if (!empty($cartId) && !empty($prodqty) && !empty($prodprice)) {
                $cartdata['pd_quantity'] = $prodqty;
                $cartdata['pd_total'] = $prodqty * $prodprice;
                // send data to model
                $added = $this->CartModel->updatecart(array('crt_id' => $cartId), $cartdata, 'carts');
                if ($added) {
                    echo $this->countcart();
                }
            }
        }
    }

    public function applycoupon($couponcode = '') // Applly Coupon
    {
        if (!empty($couponcode)) {
            $urids = $this->session->userdata('urids'); // User ID
            $cartlist = $this->CartModel->fetch_record('carts', array('user_id' => $urids), 'pd_created', 'DESC'); // Fetch Cart

            $subtotal = 0;
            $productsid = [];
            $categoriesid = [];
            foreach ($cartlist as $clist) { // GET SUb total
                $subtotal = $subtotal + $clist['pd_total'];
                $productsid[] = $clist['pd_id'];
            }
            $productsid = array_unique($productsid); // GET Unique Values

            foreach ($productsid as $pdid) { // GET Categories which is have in cart
                $prlist = $this->CartModel->fetch_record('products', array('prod_id' => $pdid, 'prod_status' => '1'), 'prod_id', 'DESC');
                $categoriesid[] = $prlist[0]['prod_cat'];
            }

            $categoriesid = array_unique($categoriesid); // GET Unique Values

            $couplist = $this->CartModel->fetch_record('coupon', array('cp_coupon_code' => $couponcode, 'cp_status' => 'Active'), 'coupon_id', 'DESC');
            if (isset($couplist[0])) {
                $couponid = $couplist[0]['coupon_id'];
                $coupon_name = $couplist[0]['cp_coupon_name'];
                $coupon_code = $couplist[0]['cp_coupon_code'];
                $type = $couplist[0]['cp_type'];
                $discount = $couplist[0]['cp_discount'];
                $total_amount = $couplist[0]['cp_total_amount'];
                $product_id = explode(',', $couplist[0]['cp_product_id']);
                $category_id = explode(',', $couplist[0]['cp_category_id']);
                $start_dated = $couplist[0]['cp_start_date'];
                $end_dated = $couplist[0]['cp_end_date'];
                $max_usesd = $couplist[0]['cp_max_uses'];
                $count_max_user = $couplist[0]['cp_count_max_user'];

                $getcat = array_intersect($categoriesid, $category_id); // It's Fetch Commen ID
                $getprod = array_intersect($productsid, $product_id); // It's Fetch Commen ID

                $enddate = $end_dated;
                $startdate = $start_dated;
                $now = date('Y-m-d');
                if ($count_max_user >= $max_usesd && !empty($max_usesd)) {
                    $result = json_encode(array('status' => false, 'message' => 'This is for first ' . $max_usesd . ' users'));
                    // } else if (count($getprod) === 0 && !empty($product_id)) {
                    //     $result = json_encode(array('status' => false, 'message' => 'This offer is particular Products'));
                    // } else if (count($getcat) != 0 && !empty($category_id)) {
                    //     $result = json_encode(array('status' => false, 'message' => 'This offer not available for these categories'));
                } else if ($enddate < $now && !empty($end_dated)) {
                    $result = json_encode(array('status' => false, 'message' => 'This offer Expire'));
                } else if ($startdate > $now) {
                    $result = json_encode(array('status' => false, 'message' => 'This offer is not active or this offer is active on ' . $startdate));
                } else {
                    // if (count($getprod) != 0) {
                    //     $subtotal = 0;
                    //     foreach ($cartlist as $clist) { // GET SUb total
                    //         if (in_array($clist['pd_id'], $getprod)) {
                    //             $subtotal = $subtotal + ($clist['pd_total'] - ($clist['pd_total'] * $discount / 100));
                    //             $productsid[] = $clist['pd_id'];
                    //         } else {
                    //             $subtotal = $subtotal + $clist['pd_total'];
                    //         }
                    //     }
                    //     $shippingcharge = ($subtotal < 500) ? 40 : 0;
                    //     $grandtotal = $subtotal + $shippingcharge;
                    //     $this->session->set_userdata('subtotal', $subtotal);
                    //     $this->session->set_userdata('grandtotal', $grandtotal);
                    //     $this->session->set_userdata('shipcarg', $shippingcharge);
                    //     // $ccart= ;
                    //     $result = json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal, 'message' => 'Coupon apply successfully'));
                    // } else if (count($getcat) != 0) {
                    //     if (in_array($clist['pd_id'], $getprod)) {
                    //         $subtotal = $subtotal + ($clist['pd_total'] - ($clist['pd_total'] * $discount / 100));
                    //         $productsid[] = $clist['pd_id'];
                    //     } else {
                    //         $subtotal = $subtotal + $clist['pd_total'];
                    //     }
                    //     $shippingcharge = ($subtotal < 500) ? 40 : 0;
                    //     $grandtotal = $subtotal + $shippingcharge;
                    //     $this->session->set_userdata('subtotal', $subtotal);
                    //     $this->session->set_userdata('grandtotal', $grandtotal);
                    //     $this->session->set_userdata('shipcarg', $shippingcharge);
                    //     // $ccart= ;
                    //     $result = json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal, 'message' => 'Coupon apply successfully'));
                    // } else {
                    if (!empty($max_uses)) {
                        $cupdata['cp_count_max_user'] = $count_max_user++;
                        $added = $this->CartModel->updatecart(array('coupon_id' => $couponid), $cupdata, 'coupon');
                    }

                    if ($subtotal < $total_amount) {
                        $result = json_encode(array('status' => 'false',  'message' => 'You are not elegible for this Coupon'));
                    } else if ($type == "Percentage" && $total_amount <= $subtotal) {
                        $subtotal = $subtotal + ($subtotal - ($subtotal * $discount / 100));
                        $subtotal = number_format($subtotal, 2);
                        $shippingcharge = ($subtotal < 500) ? 40 : 0;
                        $grandtotal = $subtotal + $shippingcharge;
                        $this->session->set_userdata('subtotal', $subtotal);
                        $this->session->set_userdata('grandtotal', $grandtotal);
                        $this->session->set_userdata('shipcarg', $shippingcharge);

                        $result = json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal, 'message' => 'Coupon apply successfully'));
                    } else if ($type = 'Fixed Amount' && $total_amount <= $subtotal) {
                        $subtotal = $subtotal - $discount;

                        $shippingcharge = ($subtotal < 500) ? 40 : 0;
                        $grandtotal = $subtotal + $shippingcharge;
                        $this->session->set_userdata('subtotal', $subtotal);
                        $this->session->set_userdata('grandtotal', $grandtotal);
                        $this->session->set_userdata('shipcarg', $shippingcharge);

                        $result = json_encode(array('status' => 'success', 'subtotal' => $subtotal, 'shippingcarg' => $shippingcharge, 'grandtotal' => $grandtotal, 'message' => 'Coupon apply successfully'));
                    }
                    // }
                }
            } else {
                $result = json_encode(array('status' => false, 'message' => 'This coupon code is not available'));
            }
            // $result = json_encode(array('status' => false, 'message' => $this->db->last_query()));

            echo $result;
        } else {
            $result = json_encode(array('status' => false, 'message' => 'Please Enter Coupon Code'));
        }
    }
}
