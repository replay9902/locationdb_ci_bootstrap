<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Map extends My_Controller{
	
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('location_m');
    }
	
    public function _remap($method)
    {
    	if( method_exists($this, $method) && $method == 'index' ){
    		$this->managelayout->add_css(BASE_URL."assets/css/map.css");
    		$this->managelayout->add_js("https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=".NAVER_MAP_CLIENTID);
    	}
    	
    	//헤더 include
    	$this->load->view('layout/header_v');
    
    	if( method_exists($this, $method) ){
    		$this->{"{$method}"}();
    	}
    	 
    	//푸터 include
    	$this->load->view('layout/footer_v');
    }
    
    
    
	public function index(){
		$this->load->view('map_v');
	}
	
	public function geocode(){
		
		if(!MEM_ID){
			redirect(base_url('auth/index'), 'location', 301);
		}

		$this->load->view('geocode_v');
// 			redirect('auth/', 'location', 301);
			 
// 	    print_r($this->session->userdata);
// 	    $address = '아중로 33';
// 	    $latlng = $this->location_m->naver_map_geocode($address);
	}
}
