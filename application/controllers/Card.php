<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// date_default_timezone_set("Asia/Kolkata");

class Card extends CI_Controller {
	private $heading,$title,$filename;
	public function __construct(){
		
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->heading = "Card Panel";
		$this->title   = "Card Panel";
		if ($this->session->userdata('logged_in')!= 1 && $this->session->userdata('logintype') !='admin') {
            redirect(base_url(), 'refresh');
        }
		$this->filename= $this->session->userdata('file');
		$this->load->model('card_model');
	}

	public function index($card=''){
		$page_data['heading']    = $this->heading;
		$page_data['pagename']   = 'card';
		$page_data['cardtype']   = $card;
		$page_data['page_title'] = $this->title;
		$page_data['filename'] 	 = $this->filename;
  		$page_data['today']	     = date('d F Y');
  		// $page_data['today']= date('F Y h:i:s');
		$this->load->view('home', $page_data);
	}

	public function print($card){
		$page_data['heading']    = 'Print Card';
		$page_data['pagename']   = 'card';
		$page_data['cardtype']   = $card;
		$page_data['page_title'] = 'Card';
		$result   	= $this->card_model->getdetail($this->filename);
		if(count($result)>0){
			$card = $this->creatcard($result,$card);
		}else{
			redirect('/');
		}
		$page_data['data'] = $card;
  		// $page_data['today']= date('F Y h:i:s');
		$this->load->view('print', $page_data);
	}

	public function creatcard($hajidata,$card){
		$html='';
		if($card=='icard'){
			foreach(array_chunk($hajidata, 8) as $data ) {
				$html.='<div class="page" style="page-break-after:always;border:2px solid transparent">';
				$i=0;
				foreach ($data as $rows) {
					if($rows['image']==''){
						$image =  'no-image.png';
					}else{
						$image =  $rows['image'];
					}
					if($i%2==0){
						$m = 'margin:0 .20cm 10px .20cm';
					}else{
						$m = 'margin:0 0 10px 0';
					}
					$html .='<div style="width:10cm;min-height:225px;background-color:white;float:left;padding:0px;'.$m.'">
					            <table style="border-spacing:0px;">
					                <tbody>
					                    <tr>
					                        <th class="AAhdr" colspan="3">
					                            <h1 style="margin-bottom:5px" class="headingfont"><span style="font-size:25px;">AASFA</span> HAJ UMRAH TOUR</h1>
					                        </th>
					                    </tr>
					                    <tr>
					                        <td class="flag" colspan="3">Indore M.P. India</td>
					                    </tr>
					                    <tr>
					                        <td rowspan="4" style="border-radius:3px;text-align:center"><img src="'.base_url().'uploads/images/'.$image.'" width="108" height="96" /></td>
					                        <td class="AAZero">
					                            <h3 class="AAZero pad0 nowwrap"> Name <span style="float:right">:</span></h3>
					                        </td>
					                        <td class="AAZero pad0">
					                            <h3 class="AAZero pad0 nowwrap">'.$rows['haji_name'].'</h3>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="AAZero">
					                            <h3 class="AAZero pad0">Passport No. <span style="float:right">:</span></h3>
					                        </td>
					                        <td class="AAZero pad0">
					                            <h3 class="AAZero pad0">'.$rows['passport_number'].'</h3>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="AAZero">
					                            <h3 class="AAZero pad0">Makkah Hotel <span style="float:right">:</span></h3>
					                        </td>
					                        <td class="AAZero pad0">
					                            <h3 class="AAZero pad0">'.$rows['makkah_hotel_name'].'</h3>
					                            <h5 class="AAZero pad0" style="color:#000">'.$rows['makkah_hotel_add'].'</h5>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="AAZero">
					                            <h3 class="AAZero pad0">Madina Hotel <span style="float:right">:</span></h3>
					                        </td>
					                        <td class="AAZero pad0">
					                            <h3 class="AAZero pad0">'.$rows['madina_hotel_name'].'</h3>
					                            <h5 class="AAZero pad0" style="color:#000">'.$rows['madina_hotel_add'].'</h5>
					                        </td>
					                    </tr>
					                    <tr>
					                        <td class="AAftr" colspan="3">
					                            <h2 class="normal">Add : 8, Haji Noor Mahal Market, In Front Of Usman Patel Gate Main Road Khajrana Indore 452016 (M.P.)
</h2>
					                            <hr />
					                            <p class="normal size12 mar5px" style="margin-top:0px;padding-bottom:2px;">Cont. No. Saudi :  0533298433
 , India : +91 9826980803
</p>
					                        </td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>';
					$i++;
				}
				$html .= '</div>';
			}
		}else if($card=='bag'){
			foreach(array_chunk($hajidata, 2) as $data ) {
				$html.='<div class="page" style="margin:auto 25px">';
				$i=0;
				foreach ($data as $rows) {
					if($rows['image']==''){
						$image =  'no-image.png';
					}else{
						$image =  $rows['image'];
					}
					
					$html .='<div style="width:730px;height:500px;background-color:white">
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
				                            <h2 class="size26 mar15px normal">Add : 8, Haji Noor Mahal Market, In Front Of Usman Patel Gate Main Road Khajrana Indore 452016 (M.P.)
</h2>
				                            <hr />
				                            <h2 class="martopbot5 size26 mar15px normal" style="font-size:23px;">Cont. No. Saudi :  0533298433
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
		}else if($card=='zamzam'){
			foreach(array_chunk($hajidata, 2) as $data ) {
				$html.='<div class="page"><div style="width:1530px;padding:0px;margin-top:575px;">';
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
				                        <h4>Add : 8, Haji Noor Mahal Market, In Front Of Usman Patel Gate Main Road Khajrana Indore 452016 (M.P.)
 Cont. No. Saudi : 0533298433
 , India : +91 9826980803

				                        </h4>
				                    </td>
				                </tr>
				            </table>
				        </div>';
					$i++;
				}
				$html .= '</div></div>';
			}
		}
		return $html;
	}
}
?>