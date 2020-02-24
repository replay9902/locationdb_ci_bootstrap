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
		$this->load->library('pagination');
		
		$page = $this->input->get('p') != "" ? intval($this->input->get('p'))  : 1;
		$search_word = $this->input->get('q');
		$location = $this->input->get('l');
		
		if($search_word){
		    $this->location_m->search_history_enroll($search_word);
		}
		
		//페이지네이션 설정
		$this->config->load('my_pagination', true);
		$config = $this->config->item('pagination', 'my_pagination');
		$config['base_url'] = BASE_URL.'map/geocode/?q='.$search_word.'&l='.$location; //페이징 주소
		$config['total_rows'] = $this->location_m->get_list('count', '', '', $search_word, $location); //게시물의 전체 갯수
		$config['num_links'] = 2;	//선택된 페이지번호 좌우로 몇개의 숫자링크를 보여줄지 설정
		$config['per_page'] = 9; //한 페이지에 표시할 게시물 수
		//$config['uri_segment'] = 3; //페이지 번호가 위치한 세그먼트
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'p';
		
		//페이지네이션 초기화
		$this->pagination->initialize($config);
		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$data['pagination'] = $this->pagination->create_links();
		$data['page'] = $page;
		
		
		$data['search_word'] = $search_word;
		$data['location'] = $location;
		$data['locations'] = $this->location_m->get_locations();
		
		
		//게시판 목록을 불러오기 위한 offset, limit 값 가져오기
		$data['start'] = $start = ($page - 1) * $config['per_page'];
		$data['total_rows'] = $config['total_rows'];
		$limit = $config['per_page'];
		
		$data['list'] = $this->location_m->get_list('', $start, $limit, $search_word, $location);
		
		$this->load->view('geocode_v', $data);
// 	    print_r($this->session->userdata);
// 	    $address = '아중로 33';
// 	    $latlng = $this->location_m->naver_map_geocode($address);
	}
}
