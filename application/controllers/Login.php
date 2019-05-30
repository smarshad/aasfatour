<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	private $heading,$title;
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->heading = "Login Panel";
		$this->title   = "Login Panel";
		if($this->session->userdata('logged_in') == TRUE && $this->session->userdata('logintype') == 'admin' ) 
			redirect('/dashboard'); 
	}

	public function index($param1=''){
		$page_data['heading']    = ucwords($param1).' '.$this->heading;
		$page_data['pagename']   = 'login';
		$page_data['page_title'] = ucwords($param1).' '.$this->title;
		$page_data['logintype']  = $param1;
		$this->load->view('login', $page_data);
	}

	
}