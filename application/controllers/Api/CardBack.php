<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('card_model');
	}


	public function getdetail(){
		$returndata = array('Response-Status' => false,'Response-Validate' => false, 'Response-Message' => array());
		$filename 	= $this->input->post('filename');
		$result   	= $this->card_model->getdetail($filename);
		if(count($result)>0){
			$card = $this->creatcard($result);
		}else{

		}
		$returndata['Response-Status']   = true;
		$returndata['Response-Validate'] = true;
		$returndata['Response-Message']  = "Successfully Upload";
		$returndata['Response-Data']  = $card;
		echo json_encode($returndata);
	}

	public function creatcard($hajidata){
		$html='';
		foreach(array_chunk($hajidata, 8) as $data ) {
			$html.='<div style="width:780px;height:950px;padding:0px;">';
			foreach ($data as $rows) {
				if($rows['image']==''){
					$image =  'no-image.png';
				}else{
					$image =  $rows['image'];
				}

				$html .='<div style="width:380px;min-height:225px;background-color:white;float:left;margin:0 6px 10px 0;padding:0px;">
				            <table style="border-spacing:0px;">
				                <tbody>
				                    <tr>
				                        <th class="AAhdr" colspan="3">
				                            <h1 style="margin-bottom:5px;"><span style="font-size:25px;">AASFA</span> HAJ UMRAH TOUR</h1>
				                        </th>
				                    </tr>
				                    <tr>
				                        <td class="flag" colspan="3">'.$rows['header'].'</td>
				                    </tr>
				                    <tr>
				                        <td rowspan="4" style="border:1px solid black;border-radius:3px;"><img src="'.base_url().'uploads/images/'.$image.'" style="width:108px;height:96px;" /></td>
				                        <td class="AAZero">
				                            <h3 class="AAZero nowwrap">Haji Name <span style="float:right">:</span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero nowwrap">'.$rows['haji_name'].'</h3>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero">Passport No. <span style="float:right">:</span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero">'.$rows['passport_number'].'</h3>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero">Makkah Hotel <span style="float:right">:</span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero">'.$rows['makkah_hotel_name'].'</h3>
				                            <h5 class="AAZero">'.$rows['makkah_hotel_add'].'</h5>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero">Madina Hotel <span style="float:right">:</span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero">'.$rows['madina_hotel_name'].'</h3>
				                            <h5 class="AAZero">'.$rows['madina_hotel_name'].'</h5>
				                        </td>
				                    </tr>
				                    <tr>
				                        <th class="AAftr" colspan="3">
				                            <h2>'.$rows['haji_address'].'</h2>
				                            <hr />
				                            <p style="margin-top:0px;padding-bottom:2px;">Cont. No. Saudi : '.$rows['saudi_mobile'].' , India : '.$rows['indian_mobile'].'</p>
				                        </th>
				                    </tr>
				                </tbody>
				            </table>
				        </div>';
			}
			$html .= '</div>';
		}
		return $html;
	}

	public function importData($path){
		$this->load->library('excel');
		$file = "./uploads/".$path;
		$objPHPExcel 	 = PHPExcel_IOFactory::load($file);
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		foreach ($cell_collection as $cell) {
			$column		= $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			$row        = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			$arr_data[$row][$column] = $data_value;
		}
		$data['values'] = $arr_data;
		$insdata 		= array();
		// print_r($arr_data);exit();
		foreach ($data['values'] as $key => $value){
			if($data['values'][$key]['A'] != ''){
				$header  			= addslashes($data['values'][$key]['A']);
				$haji_name  		= addslashes($data['values'][$key]['B']);
				$passport_number  	= addslashes($data['values'][$key]['C']);
				$makkah_hotel_name  = addslashes($data['values'][$key]['D']);
				$makkah_hotel_add  	= addslashes($data['values'][$key]['E']);
				$madina_hotel_name  = addslashes($data['values'][$key]['F']);
				$madina_hotel_add  	= addslashes($data['values'][$key]['G']);
				$haji_address  		= addslashes($data['values'][$key]['H']);
				$saudi_mobile  		= addslashes($data['values'][$key]['I']);
				$indian_mobile  	= addslashes($data['values'][$key]['J']);
				$image  			= addslashes($data['values'][$key]['K']);
		
				$insdata[] = array(
					'header'  		   => $header,
					'haji_name' 	   => $haji_name,
					'passport_number'  => $passport_number,
					'makkah_hotel_name'=> $makkah_hotel_name,
					'makkah_hotel_add' => $makkah_hotel_add,
					'madina_hotel_name'=> $madina_hotel_name,
					'madina_hotel_add' => $madina_hotel_add,
					'haji_address' 	   => $haji_address,
					'saudi_mobile'	   => $saudi_mobile,
					'indian_mobile'	   => $indian_mobile,
					'image' 		   => $image,
					'filename'	   	   => $path,
					'uploaded_date'	   => date('Y-m-d H:i:s')
				);
			}
		}
		return $this->db->insert_batch('master_haji',$insdata);
	}

    public function doupload(){  
    	$returndata = array('Response-Status' => false,'Response-Validate' => false, 'Response-Message' => array());
    	$success = 0;
        $upload_path 			 = $this->config->item('upload_path');
        is_dir($upload_path);
        $config['upload_path']   =  $upload_path;
	    $config['allowed_types'] = 'xlsx|xls';
	    $config['max_size']      = '1000';
	    $config['overwrite']	 = FALSE;
		$config['encrypt_name']	 = TRUE;
		$config['remove_spaces'] = TRUE;
	    $this->load->library('upload', $config);
	    $this->upload->initialize($config);
	    //print_r($config);
	    if(!$this->upload->do_upload('excelFile')){
	      	$returndata['Response-Validate'] = false;
			$returndata['Response-Message']  = $this->upload->display_errors();
			$success = 0;
	    }else{
	      $data = array('upload_data' => $this->upload->data());
	  	  $success = $this->importData($data['upload_data']['file_name']);
	    }

	    if($success>0){
			$returndata['Response-Status']   = true;
			$returndata['Response-Validate'] = true;
			$returndata['Response-Message']  = "Successfully Upload";
			$returndata['Response-Filename']  = $data['upload_data']['file_name'];
		}
		$this->session->set_userdata('file', $data['upload_data']['file_name']);
		echo json_encode($returndata);
    }
}
