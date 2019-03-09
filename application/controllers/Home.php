<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

	public function index()
	{
        $redirect = '/admin/capital/entries';

//        if(!$this->session->userdata('logged_in')) {
//            $redirect = '/admin/login';
//        }
        redirect( $redirect );
//		$this->render('home', 'full_width');
	}
}
