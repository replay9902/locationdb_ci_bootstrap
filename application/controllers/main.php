<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
    	
    	//헤더 include
		$this->load->view('layout/header_v');
    
    	if( method_exists($this, $method) )
    	{
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
		/*
		setgment 순서
		main/index/페이지/키워드/전주시/
		1 : 컨트롤러
		2 : 메서드
		3 : 페이지
		4 : 검색
		5 : 지역
		*/
		
		$this->load->helper('text');
		
		$page = $this->input->get('p') != "" ? intval($this->input->get('p'))  : 1;
		$search_word = $this->input->get('q');
		$location = $this->input->get('l');
		
	
		
		//페이지네이션 설정
		$config['base_url'] = BASE_URL.'main/index/?q='.$search_word.'&l='.$location; //페이징 주소
		$config['total_rows'] = $this->location_m->get_list('count', '', '', $search_word, $location); //게시물의 전체 갯수
		$config['num_links'] = 2;	//선택된 페이지번호 좌우로 몇개의 숫자링크를 보여줄지 설정
		$config['per_page'] = 9; //한 페이지에 표시할 게시물 수
		//$config['uri_segment'] = 3; //페이지 번호가 위치한 세그먼트
		$config['reuse_query_string'] = true;
		$config['query_string_segment'] = 'p';
		
		$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<span aria-hidden="true">«</span> <span class="sr-only">Previous</span>';
		$config['first_tag_open'] = $config['last_tag_open'] = $config['num_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = $config['last_tag_close'] = $config['num_tag_close'] = '</li>';
		$config['last_link'] = '<span aria-hidden="true">&raquo;</span> <span class="sr-only">Next</span>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['use_page_numbers'] = TRUE;
		$config['anchor_class'] = 'class="page-link" ';
		
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
	    $data['attachs'] = $this->location_m->get_attachs($id);
	    $this->load->view('view_v', $data);
	}
	
	
	
	/**
	 * url중 키값을 구분하여 값을 가져오도록.
	 *
	 * @param Array $url : segment_explode 한 url값
	 * @param String $key : 가져오려는 값의 key
	 * @return String $url[$k] : 리턴값
	 */
	function url_explode($url, $key)
	{
		$cnt = count($url);
		for($i=0; $cnt>$i; $i++ )
		{
			if($url[$i] ==$key)
			{
				$k = $i+1;
				return $url[$k];
			}
		}
	}
	
	/**
	 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
	 *
	 * @param	string	대상이 되는 문자열
	 * @return	string[]
	 */
	function segment_explode($seg)
	{
		//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
		$len = strlen($seg);
		if(substr($seg, 0, 1) == '/')
		{
			$seg = substr($seg, 1, $len);
		}
		$len = strlen($seg);
		if(substr($seg, -1) == '/')
		{
			$seg = substr($seg, 0, $len-1);
		}
		$seg_exp = explode("/", $seg);
		return $seg_exp;
	}
	
	
}
