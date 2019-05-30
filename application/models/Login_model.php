<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {
	private $table;
	private $table1;
	public function __construct(){
		$this->table  = 'company';
		$this->table1 = 'company_details';
		parent::__construct();
		$this->load->library('bcrypt');
	}

	public function login($email,$password){
		$query   = "SELECT * FROM master_admin WHERE username = ?";
		$runtwo	 = $this->db->query($query, array($email));
		$row     = $runtwo->row();
        $numrows = $runtwo->num_rows();
        if($numrows === 1){
			if($row->activated){
				$checkpassword = $this->checkpassword($password, $row->password);
				if($checkpassword == 1){
						$newdata = array(
							'user_id' 	=> $row->id,
							'logintype'	=> 'admin',
							'user_name' => $email,
							'email' 	=> $row->email,
							'filename' 	=> '',
							'logged_in' => TRUE,
						);
					$this->session->set_userdata($newdata);
					$data2['user_id']    = $row->id;
					$data2['login_type'] = 'admin';
					$data2['ip_address'] = $this->input->ip_address();
					$this->db->insert("master_log", $data2);
					$result = array('msg' => 'Successfully Login!','status' => true, 'success' => true);
				}else{
					$result = array('msg' => 'Incorrect Password!','status' => false, 'success' => true);
				}
			}else{
				$result = array('msg' => 'User Account Not Activated!','status' => false, 'success' => true);
			}
		}else{
			$result = array('msg' => 'No Record Found!','status' => false, 'success' => true);
		}
		return $result;
	}

	public function checkpassword($password, $stored_hash){
		if ($this->bcrypt->check_password($password, $stored_hash)){
			return 1;
		 	// Password does match stored password.
		}else{
			return 0;
		 	// Password does not match stored password.
		}
	}

}
