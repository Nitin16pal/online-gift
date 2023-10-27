<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logins'] = 'user/userlogin';
$route['signup'] = 'user/user_regstration';
$route['usrlogout'] = 'user/userlogout';
$route['user-address'] = 'user/update_address';
$route['place-orders'] = 'user/place_orders';
$route['place-orders/(:num)'] = 'user/place_orders/$1';// This  url not use in any file or place

$route['cart'] = 'cart/cart';
$route['countcarts'] = 'cart/countcart';
$route['addcart/(:any)'] = 'cart/addcart/$1';
$route['addcart/(:any)/(:any)'] = 'cart/addcart/$1/$2';
$route['updatecart/(:any)/(:any)/(:any)'] = 'cart/updatecart/$1/$2/$3';
$route['deletecart/(:any)'] = 'cart/deletecart/$1';
$route['applycoupon'] = 'cart/applycoupon';
$route['applycoupon/(:any)'] = 'cart/applycoupon/$1';

$route['checkout'] = 'user/checkout';
$route['order-history'] = 'user/order_history';
$route['order-details/(:any)'] = 'user/order_details/$1';

$route['order-cancel/(:any)'] = 'user/order_cancel/$1';


$route['shipping-and-delivery'] = 'other/shipping_and_delivery';
$route['refund-and-cancellation'] = 'other/refund_and_cancellation';
$route['privacy-and-policy'] = 'other/privacy_and_policy';
$route['terms-and-condition'] = 'other/terms_and_condition';
$route['contact-us'] = 'other/contact';


$route['products-search'] = 'home/products_search';

$route['products/(:any)'] = 'home/products/$1';
$route['products/(:any)/(:any)'] = 'home/products/$1/$2';
$route['product/(:any)/(:any)'] = 'home/products/$1/$2';
$route['product/(:any)/(:any)'] = 'home/products_details/$1/$2';
$route['product/(:any)/(:any)/(:any)'] = 'home/products_details/$1/$2/$3';




