<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam1 extends CI_Controller {

	public function index()
	{
		$this->exam_visitor();
	}
	
	function exam_visitor(){
		date_default_timezone_set("Asia/Bangkok");
		$this->load->view('v_exam_visitor');
	}
	
	function save_visitor(){
		date_default_timezone_set("Asia/Bangkok");
		header("Access-Control-Allow-Origin:*");
		$url = $this->input->post("url");
		$host = $this->input->post("host");
		$path = $this->input->post("path");
		$ip_address = $this->input->post("ip_address");
		$browser_name = $this->input->post("browser_name");
		$platform = $this->input->post("platform");
		$is_mobile = $this->input->post("is_mobile") == "true" ? "Y" : "N";
		
		$this->load->model('Main_model','model');
		
		$result = $this->model->insert_visitor($platform, $ip_address, $url, $host, $path, $browser_name, $is_mobile);
		
		if($result){
			echo json_encode("บันทึกสำเร็จ");
		}else{
			echo json_encode("บันทึกไม่สำเร็จ");
		}
	}
	
	function get_count_visitor(){
		date_default_timezone_set("Asia/Bangkok");
		$date = $this->input->post("date");
		$this->load->model('Main_model','model');
		
		$result = $this->model->get_count_visitor_from_date($date)->row();
		
		$arr_data = array('daily'=>$result->daily, 'monthly'=>$result->monthly);
		
		echo json_encode($arr_data);
	}
	
	function report_visitor(){
		date_default_timezone_set("Asia/Bangkok");
		$this->load->model('Main_model','model');
		
		// get browser
		$data['rs_brand'] = $this->model->get_browser();
		
		// get platform
		$data['rs_platform'] = $this->model->get_platform();
		
		// get data
		$data['date_start'] = $date_start = $this->input->post("date_start") ? $this->input->post("date_start") : date("Y-m-d");
		$data['date_end'] = $date_end = $this->input->post("date_end") ? $this->input->post("date_end") : date("Y-m-d");
		$data['website'] = $website = $this->input->post("website") ? $this->input->post("website") : "";
		$data['path'] = $path = $this->input->post("path") ? $this->input->post("path") : "";
		$data['ipaddress'] = $ipaddress = $this->input->post("ipaddress") ? $this->input->post("ipaddress") : "";
		$data['platform'] = $platform = $this->input->post("platform") ? $this->input->post("platform") : array();
		$data['brand'] = $brand = $this->input->post("brand") ? $this->input->post("brand") : array();
		$data['is_mobile'] = $is_mobile = $this->input->post("is_mobile") ? $this->input->post("is_mobile") : "A";		
		
		
		$data['rs_data'] = $this->model->search_data($date_start, $date_end, $website, $path, $ipaddress, $platform, $brand, $is_mobile);
		
		$this->load->view('v_report_visitor', $data);
	}
}
?>