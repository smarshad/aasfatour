<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('login_model');$this->load->library('bcrypt');
	 }


	public function signin(){
		$data 	   = array('Response-Status' => false,'Response-Validate' => false, 'Response-Message' => array());
		$username  = $this->input->post('username');
		$password  = $this->input->post('current-password');
		$this->form_validation->set_rules('username', 'User Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('current-password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
		$this->form_validation->set_message('required', 'Enter %s');

	if($this->form_validation->run()) {
		$result = $this->login_model->login($username,$password);
		if($result['status']==true){
			$data['Response-Status']   = $result['status'];
			$data['Response-Validate'] = true;
			$data['Response-Message']  = $result['msg'];
		}else{
			$data['Response-Status']   = $result['status'];
			$data['Response-Validate'] = true;
			$data['Response-Message']  = $result['msg'];
		}
	}else{
		foreach ($this->input->post() as $key => $value) {
			$data['Response-Message'][$key] = form_error($key);
		}
	}
	 echo json_encode($data);
 }
public function logout(){
		$ltype   = $this->session->userdata('logintype'); 
		$newdata = array(
			'user_id' 	=> '',
			'logintype'	=> '',
			'user_name' => '',
			'email' 	=> '',
			'logged_in' => FALSE,
		);
		$this->session->unset_userdata($newdata);
		$this->session->sess_destroy();		
		redirect('/login/'.$ltype, 'refresh');
	}	
}
