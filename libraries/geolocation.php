<?php if( ! defined('BASEPATH')) exit ('No direct script access allowed.');

/**
 *
 * @package		CI Geolocations 2
 * @desc                Renewed geolocation library uses maxmind.com offline databases
 * @author		Barna Szalai <http://www.subdesign.hu>
 * @copyright	        Copyright (c) 2011 Barna Szalai
 * @version		2.0
 */ 

class geolocation {

	function get_geolocations() {
		
		$CI =& get_instance();
	
		//Init variables
		$this->time = time();
		$this->time_check = $this->time-600;
		$this->session_id = $CI->session->userdata('session_id');
		$this->ip = $CI->input->ip_address();
		
		//Delete session if older than 10 minutes
		$CI->db->where('timestamp <', $this->time_check)
			   ->delete('user_online');

		//Get one session, if not exists then create one
		$q = $CI->db->where('session_id', $this->session_id)
			        ->get('user_online');
				
		if($q->num_rows() > 0) {
			$CI->db->set('timestamp', $this->time, FALSE)
				   ->where('session_id', $this->session_id)
				   ->update('user_online');	
		} else {
			$data2 = array(
				'ip' => $this->ip,
				'session_id' => $this->session_id,
				'timestamp' => $this->time
			);	
			$CI->db->insert('user_online', $data2);
		}
		$q->free_result();
		
		//Get locations
		$query = $CI->db->select('DISTINCT(ip)')
						->group_by('ip')
						->get('user_online');
		if($query->num_rows() > 0) {
			$ips = $query->result();	
		}
		$query->free_result();
				
		//Get online user geo datas
		foreach($ips as $ip) {
			$locations[] = geoip_record_by_name($ip->ip); 
			$lastkey = array_pop(array_keys($locations));
			$locations[$lastkey]['ip'] = $ip->ip;
		}
		
		//Getting the result
		if (!empty($locations) && is_array($locations)) {
		  	return $locations;
		}
		else
		{
			return FALSE;	
		}
	}
}
