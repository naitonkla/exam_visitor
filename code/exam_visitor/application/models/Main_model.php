<?php
class Main_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
		date_default_timezone_set("Asia/Bangkok");
	}
	
	function get_count_visitor_from_date($date){
		$day_search = substr($date, 0, 7);
		$sql = "SELECT
					date(vist_timestamp) as date,
					count(if(date(vist_timestamp) = '".$date."',1,NULL)) as daily,
					count(*) as monthly
				FROM visitor
				WHERE vist_timestamp like '".$day_search."%'";
		return $this->db->query($sql);
	}
	
	function search_data($date_start, $date_end, $website, $path, $ipaddress, $platform, $brand, $is_mobile){
		$str = "";
		if($website != ""){
			$str .= " AND vist_hostname = '".$website."'";
		}
		if($path != ""){
			$str .= " AND vist_pathname like '".$path."%'";
		}
		if($ipaddress != ""){
			$str .= " AND vist_ip_address = '".$ipaddress."'";
		}
		if(count($platform) > 0){
			$str .= " AND vist_platform in ('".implode("', '", $platform)."')";
		}
		if(count($brand) > 0){
			$str .= " AND vist_brand in ('".implode("', '", $brand)."')";
		}
		if($is_mobile != "A"){
			$str .= " AND vist_is_mobile = '".$is_mobile."'";
		}
		$sql = "select * 
				from visitor
				WHERE date(vist_timestamp) >= ? AND date(vist_timestamp) <= ?
					".$str."
				ORDER BY vist_timestamp DESC";
		return $this->db->query($sql, array($date_start, $date_end));
	}
	
	function get_browser(){
		$sql = "select vist_brand from visitor GROUP BY vist_brand order by vist_brand";
		return $this->db->query($sql);
	}
	
	function get_platform(){
		$sql = "select vist_platform from visitor GROUP BY vist_platform order by vist_platform";
		return $this->db->query($sql);
	}
	
	function insert_visitor($platform, $ip_address, $url, $host, $path, $browser_name, $is_mobile){
		date_default_timezone_set("Asia/Bangkok");
		$sql = "insert into visitor value (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
		return $this->model->db->query($sql, array($platform, $ip_address, $url, $host, $path, $browser_name, $is_mobile, date("Y-m-d H:i:s")));
	}
}
?>
