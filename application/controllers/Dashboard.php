<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	private $heading,$title;
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		if ($this->session->userdata('logged_in')!= 1 && $this->session->userdata('logintype') !='admin') {
            redirect(base_url(), 'refresh');
        }
		$this->heading = "Dashboard Panel";
		$this->title   = "Dashboard Panel";
	}

	public function index(){
		$page_data['heading']    = $this->heading;
		$page_data['pagename']   = 'dashboard';
		$page_data['page_title'] = $this->title;
		$this->load->view('home', $page_data);
	}

	public function logout(){
		$newdata = array(
			'user_id' 	=> '',
			'logintype'	=> '',
			'user_name' => '',
			'email' 	=> '',
			'logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();		
		redirect('/', 'refresh');
	}	
}
?>
