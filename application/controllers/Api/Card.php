<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Card extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('card_model');
	}


	public function getdetail($type){
		$returndata = array('Response-Status' => false,'Response-Validate' => false, 'Response-Message' => array());
		$filename 	= $this->input->post('filename');
		$result   	= $this->card_model->getdetail($filename);
		if(count($result)>0){
			$card = $this->creatcard($result,$type);
		}else{

		}
		$returndata['Response-Status']   = true;
		$returndata['Response-Validate'] = true;
		$returndata['Response-Message']  = "Successfully Upload";
		$returndata['Response-Data']  = $card;
		$returndata['Response-Ctype']  = $type;
		echo json_encode($returndata);
	}

	public function creatcard($hajidata,$type){
		$html='';
		if($type=='icard'){
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
					                            <h1 style="margin-bottom:5px" class="headingfont"><span style="font-size:25px;">AASFA</span> HAJ UMRAH TOUR</h1>
					                        </th>
					                    </tr>
					                    <tr>
					                        <td class="flag" colspan="3">Indore M.P. INDIA</td>
					                    </tr>
					                    <tr>
					                        <td rowspan="4" style="border:1px solid black;border-radius:3px;"><img src="'.base_url().'uploads/images/'.$image.'" style="width:108px;height:96px;" /></td>
					                        <td class="AAZero">
					                            <h3 class="AAZero nowwrap"> Name <span style="float:right">:</span></h3>
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
					                            <h5 class="AAZero" style="color:#000!important">'.$rows['makkah_hotel_add'].'</h5>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="AAZero">
					                            <h3 class="AAZero">Madina Hotel <span style="float:right">:</span></h3>
					                        </td>
					                        <td class="AAZero">
					                            <h3 class="AAZero">'.$rows['madina_hotel_name'].'</h3>
					                            <h5 class="AAZero" style="color:#000!important">'.$rows['madina_hotel_name'].'</h5>
					                        </td>
					                    </tr>
					                    <tr>
					                        <th class="AAftr" colspan="3">
					                            <h2>Add : 8, Haji Noor Mahal Market, In Front Of Usman Patel Gate Main Road Khajrana Indore 452016 (M.P.)
</h2>
					                            <hr />
					                            <p style="margin-top:0px;padding-bottom:2px;">Cont. No. Saudi : 0533298433
 , India : +91 9826980803
</p>
					                        </th>
					                    </tr>
					                </tbody>
					            </table>
					        </div>';
				}
				$html .= '</div>';
			}
		}else if($type=='zamzam'){
			foreach(array_chunk($hajidata, 2) as $data ) {
				$html.='<div class="page" style="margin-top:575px">';
				$i=0;
				foreach ($data as $rows) {
					if($i%2==0){
						$class='width:1530px;background-color:white;margin-right:4px;margin-left:-430px;padding:0px;';
					}else{
						$class='width:1530px;background-color:white;padding:0px;margin-top:-330px;margin-left:70px;';
					}
					$html .='<div style="'.$class.'" class="zamzambotle">
				            <table style="border-spacing:0px;-webkit-transform: rotate(-90deg);">
				                <tr>
				                    <td colspan="4">
				                        <h1 style="margin-bottom:5px" class="headingfont"><span style="font-size:130px;">AASFA</span> HAJ UMRAH TOUR</h1>
				                    </td>
				                </tr>
				                <tr>
				                    <td colspan="2">
				                        <h2> Name : </h2>
				                    </td>
				                    <td colspan="2">
				                        <h2>'.$rows['haji_name'].'</h2>
				                    </td>
				                </tr>
				                <tr>
				                     <td colspan="2">
				                        <h4>Passport No. : '.$rows['passport_number'].' </h4>
				                    </td>
				                     <td colspan="2">
				                        <h4>PNR No. : '.$rows['pnrno'].' </h4>
				                    </td>
				                </tr>
				                <tr>
				                    <td colspan="4">
				                        <h4>Add : 8, Haji Noor Mahal Market, In Front Of Usman Patel Gate Main Road Khajrana Indore 452016 (M.P.) Cont. No. Saudi :0533298433 , India : +91 9826980803

				                        </h4>
				                    </td>
				                </tr>
				            </table>
				        </div>';
					$i++;
				}
				$html .= '</div>';
			}
		}else if($type=='bag'){
			foreach(array_chunk($hajidata, 8) as $data ) {
				$html.='<div class="page">';
				$i=0;
				foreach ($data as $rows) {
					if($rows['image']==''){
						$image =  'no-image.png';
					}else{
						$image =  $rows['image'];
					}
					if($i%2==0){
						$m = 'margin:0 2px 10px 0';
					}else{
						$m = 'margin:0 0 10px 0';
					}
					$html .='<div style="width:730px;height:500px;background-color:white;float:left;">
				            <table style="border-spacing:0px;width:100%">
				                <tbody>
				                    <tr>
				                        <th class="AAhdr" colspan="3">
				                            <h1 class="bagheding headingfont"><span style="font-size:60px;">AASFA</span> HAJ UMRAH TOUR</h1>
				                        </th>
				                    </tr>
				                    <tr>
				                        <td class="flag height50 size32" colspan="3">Indore M.P. INDIA</td>
				                    </tr>
				                    <tr class="normal">
				                        <td rowspan="4" style="border:1px solid black;border-radius:3px;width:150px"><img src="'.base_url().'uploads/images/'.$image.'" style="width:150px;height:150px;" /></td>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26"> Name <span style="float:right;"> : </span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">'.$rows['haji_name'].'</h3>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">Passport No. <span style="float:right;"> : </span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">'.$rows['passport_number'].'</h3>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">Makkah Hotel <span style="float:right;"> : </span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">'.$rows['makkah_hotel_name'].'</h3>
				                            <h5 class="AAZero size13" style="color:#000!important">'.$rows['makkah_hotel_add'].'</h5>
				                        </td>
				                    </tr>
				                    <tr>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">Madina Hotel <span style="float:right;"> : </span></h3>
				                        </td>
				                        <td class="AAZero">
				                            <h3 class="AAZero size26">'.$rows['madina_hotel_name'].'</h3>
				                            <h5 class="AAZero size13" style="color:#000!important">'.$rows['madina_hotel_add'].'</h5>
				                        </td>
				                    </tr>
				                    <tr>
				                        <th class="AAftr" colspan="3">
				                            <h2 class="size26 mar15px normal"></h2>
				                            <hr />
				                            <h2 class="martopbot5 size26 mar15px normal">Cont. No. Saudi : 0533298433
, India : +91 9826980803
</h2></th>
				                    </tr>
				                </tbody>
				            </table>
				        </div>';
					$i++;
				}
				$html .= '</div>';
			}
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
			$key = $key + 1;
			if($data['values'][$key]['A'] != ''){
				$haji_name  		= addslashes($data['values'][$key]['A']);
				$passport_number  	= addslashes($data['values'][$key]['B']);
				$makkah_hotel_name  = addslashes($data['values'][$key]['C']);
				$makkah_hotel_add  	= addslashes($data['values'][$key]['D']);
				$madina_hotel_name  = addslashes($data['values'][$key]['E']);
				$madina_hotel_add  	= addslashes($data['values'][$key]['F']);		
				$image  			= addslashes($data['values'][$key]['G']);
				$pnrno	 			= addslashes($data['values'][$key]['H']);
		
				$insdata[] = array(
					'haji_name' 	   => $haji_name,
					'passport_number'  => $passport_number,
					'makkah_hotel_name'=> $makkah_hotel_name,
					'makkah_hotel_add' => $makkah_hotel_add,
					'madina_hotel_name'=> $madina_hotel_name,
					'madina_hotel_add' => $madina_hotel_add,
					'image' 		   => $image,
					'filename'	   	   => $path,
					'pnrno'	   	   	   => $pnrno,
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
