<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Map extends My_Controller{
	
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('location_m');
    }
	
    
	public function index(){
		$this->load->view('map_v');
	}
	
	public function geocode(){
	    
	    $address = '아중로 33';
	    $latlng = $this->location_m->naver_map_geocode($address);
	}
}
