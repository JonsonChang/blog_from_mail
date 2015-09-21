<?php
class db_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function get_web_list($offset,$segment)
	{
		$this->db->from("website");
		$total =$this->db->count_all_results();

		$query = $this->db->get('website',$segment,$offset);
		$query_data = $query->result_array();
		
		$return_array = array(
			"total" => $total,
			"query_data" => $query_data,
		);
		
		//print_r($return_array);  exit;
		return $return_array;
	}
    
	public function get_append_list($offset,$segment)
	{
		$this->db->from("appendtext");
		$total =$this->db->count_all_results();

		$query = $this->db->get('appendtext',$segment,$offset);
		$query_data = $query->result_array();
		
		$return_array = array(
			"total" => $total,
			"query_data" => $query_data,
		);
		
		//print_r($return_array);  exit;
		return $return_array;
	}

}

