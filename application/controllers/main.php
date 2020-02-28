<?php 
class Main extends My_Controller{
	
	 public function __construct()
    {
        parent::__construct();
        $this->load->model('location_m');
    }
	
    
    /**
     * 사이트 헤더, 푸터를 자동으로 추가해준다.
     */
    public function _remap($method)
    {
    	if( method_exists($this, $method) && $method == 'view' ){
	    	$this->managelayout->add_css(BASE_URL."assets/css/jquery.fancybox-1.3.4.css");
	    	$this->managelayout->add_js(BASE_URL."assets/js/jquery.mousewheel-3.0.4.pack.js");
	    	$this->managelayout->add_js(BASE_URL."assets/js/jquery.fancybox-1.3.4.pack.js");
    	}
    	$data['rand'] = rand(1, 10000);
    	//헤더 include
		$this->load->view('layout/header_v', $data);
    
    	if( method_exists($this, $method) ){
    		$this->{"{$method}"}();
    	}
    	
    	//푸터 include
		$this->load->view('layout/footer_v');
    }
    
    
	public function index(){
		$this->lists();
	}
	
	/**
	 * 목록 불러오기
	 */
	public function lists()
	{
// 		$this->output->enable_profiler(TRUE);
		//페이지네이션 라이브러리 로딩 추가
		
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->helper(array('text', 'form',  'alert'));
		
		
		
		$page = $this->input->get('p') != "" ? intval($this->input->get('p'))  : 1;
		$search_word = $this->input->get('q');
		$location = $this->input->get('l');
		
		if($search_word){
		    $this->location_m->search_history_enroll($search_word);
		}
	
		//페이지네이션 설정
		$this->config->load('my_pagination', true);
		$config = $this->config->item('pagination', 'my_pagination');
		$config['base_url'] = BASE_URL.'main/index/?q='.$search_word.'&l='.$location; //페이징 주소
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
		$start = ($page - 1) * $config['per_page'];
		$limit = $config['per_page'];
		
		$data['list'] = $this->location_m->get_list('', $start, $limit, $search_word, $location);
		
		
		$this->load->view('list_v', $data);
	}
	
	
	
	public function view(){
		
	    $id = intval($this->uri->segment(3));
	    
	    $data['page'] = intval($this->input->get('p'));
	    $data['search_word'] = $this->input->get('q');
	    $data['location'] = $this->input->get('l');
	    
	    $data['article'] = $this->location_m->get_view($id);
	    if($data['article'] != null) {
    	    $data['attachs'] = $this->location_m->get_attachs($id);
    	    $this->load->view('view_v', $data);
	    }else{
	        $this->load->helper('alert');
	        alert('잘못된 접근입니다', BASE_URL);
	    }
	}
	
	
	
	
}
