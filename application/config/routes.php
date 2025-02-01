<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'HomeController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['get_data_from_api'] = 'HomeController/get_data_from_api';

$route['product'] = 'ProductController/index';
$route['product/(:num)'] = 'ProductController/show/$1';
$route['product/create'] = 'ProductController/create';
$route['product/(:num)/edit'] = 'ProductController/edit/$1';
$route['product/update/(:num)'] = 'ProductController/update/$1';
$route['product/delete/(:num)'] = 'ProductController/delete/$1';


