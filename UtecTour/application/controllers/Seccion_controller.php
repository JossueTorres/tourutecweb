<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seccion_controller extends CI_Controller
{
	public function index()
	{        
		// $url = 'http://localhost:8080/UtecTourServices/Seccion/listado/';
        //creamos        
		// $_param = array(
		// 	'ddlSec' => $this->input->post("ddlsec"),
		// 	'ddlIdm' => $this->input->post("ddlidm"),
		// );
		//__________________________________________________________________________________
		// $postData = '';
		// //create name value pairs seperated by &
		// foreach ($_param as $k => $v) {
		// 	$postData .= $k . '=' . $v . '&';
		// }
		// rtrim($postData, '&');

		$ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
		$url = 'http://localhost:8080/UtecTourServices/Recursos/listado';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		curl_setopt($ch, CURLOPT_COOKIE, 'NID=67=pdjIQN5CUKVn0bRgAlqitBk7WHVivLsbLcr7QOWMn35Pq03N1WMy6kxYBPORtaQUPQrfMK4Yo0vVz8tH97ejX3q7P2lNuPjTOhwqaI2bXCgPGSDKkdFoiYIqXubR0cTJ48hIAaKQqiQi_lpoe6edhMglvOO9ynw; PREF=ID=52aa671013493765:U=0cfb5c96530d04e3:FF=0:LD=en:TM=1370266105:LM=1370341612:GM=1:S=Kcc6KUnZwWfy3cOl; OTZ=1800625_34_34__34_; S=talkgadget=38GaRzFbruDPtFjrghEtRw; SID=DQAAALoAAADHyIbtG3J_u2hwNi4N6UQWgXlwOAQL58VRB_0xQYbDiL2HA5zvefboor5YVmHc8Zt5lcA0LCd2Riv4WsW53ZbNCv8Qu_THhIvtRgdEZfgk26LrKmObye1wU62jESQoNdbapFAfEH_IGHSIA0ZKsZrHiWLGVpujKyUvHHGsZc_XZm4Z4tb2bbYWWYAv02mw2njnf4jiKP2QTxnlnKFK77UvWn4FFcahe-XTk8Jlqblu66AlkTGMZpU0BDlYMValdnU; HSID=A6VT_ZJ0ZSm8NTdFf; SSID=A9_PWUXbZLazoEskE; APISID=RSS_BK5QSEmzBxlS/ApSt2fMy1g36vrYvk; SAPISID=ZIMOP9lJ_E8SLdkL/A32W20hPpwgd5Kg1J');

		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		// curl_setopt($ch, CURLOPT_POST, count($postData));
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		$output = curl_exec($ch);
        // $last = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);	

        curl_close($ch);        
		        
		$data['lista'] = json_decode($output);
		$this->load->view('_layout/header');
		$this->load->view('Seccion', $data);
		$this->load->view('_Layout/footer');
	}

}