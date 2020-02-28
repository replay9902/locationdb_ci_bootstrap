<?php
class Auth extends My_Controller{
    
    function __construct(){
        
        parent::__construct();
    }
    
    public function index()
    {
    	
    	if(MEM_ID)
    		redirect(base_url('main/index'), 'location', 301);
    	else
    		$this->login();
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
    
    
	public function login(){
    	
		$this->load->library('form_validation');
		$this->load->helper('alert');
		
		$this->form_validation->set_rules('mem_id', '아이디', 'required|xss_clean|alpha_numeric');
    	$this->form_validation->set_rules('mem_pw', '비밀번호', 'required|xss_clean|alpha_numeric');
		   
    	if ( $this->form_validation->run() == TRUE )
    	{
    		$this->load->model('login_m');
    		$userInfo = $this->login_m->do_login();
    	
    		if($userInfo){
	    		$this->session->set_userdata('mem_id', $userInfo['mem_id']);
		    	$this->session->set_userdata('mem_nm', $userInfo['mem_nm']);
	    	
		    	$this->login_m->logindate_update($userInfo['mem_id']);
	    		alert('로그인 되었습니다.', BASE_URL.'main');
	    		exit;
    			
    		}else{
    			alert('아이디나 비밀번호를 확인해 주세요.', BASE_URL.'auth');
    			exit;    			
    		}
    		
    	}else{
    		
	    	$this->load->view('auth/login_v');
    	}
    }
    

    function logout(){
    	
    	$this->load->helper('alert');
    	$this->session->sess_destroy();
    	
    	alert('로그아웃 되었습니다.', BASE_URL.'auth');
    	exit;
	}
	
	
	
}
?>