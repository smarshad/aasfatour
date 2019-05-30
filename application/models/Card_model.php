<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Card_model extends CI_Model {
	private $table;
	public function __construct(){
		parent::__construct();
	}

	public function getdetail($filename){
		$query   = "SELECT * FROM master_haji WHERE filename = ?";
		$runtwo	 = $this->db->query($query, array($filename));
		$result  = $runtwo->result_array();
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
