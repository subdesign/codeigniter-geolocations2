<?php
class Geolocations extends CI_Controller {

	function __construct() { 
		parent::__construct();
		$this->load->library('geolocation');
	}
	
	function index() {
		$data['geolocations'] = $this->geolocation->get_geolocations();	
		$this->load->view('geolocations', $data);
	}
}