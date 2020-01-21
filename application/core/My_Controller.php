<?php
class My_Controller extends CI_Controller {
    //게시판 모델 전역 변수
    //public $model_name;
    //전역 설정값 배열
    //public $gb = array();
    //$model_name_temp = explode("/", $_SERVER['REQUEST_URI']);
    //$model_name = $model_name_temp[1]."_model";
    /**
     * 생성자
     * 기본값 세팅
     */
    function __construct()
    {
         parent::__construct();
         
         // url path
         $path_arr = parse_url(base_url());
         $path = $path_arr['path'];
         define('BASE_URL', $path);
         define('BASE_PATH', getcwd()."/");
         
         header("Content-Type: text/html; charset=UTF-8");
         
         // 세션 정보 DEFINE
         $mem_id = $this->session->userdata('mem_id');
         $mem_nm = $this->session->userdata('mem_nm');
         define("MEM_ID", $mem_id);
         define("MEM_NM", $mem_nm);
         
         
         unset($path);
    }
     
}
