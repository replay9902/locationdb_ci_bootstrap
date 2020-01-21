<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location_m extends My_Model
{
	
	var $lo_table = 'location';
	var $lo_attach_table = 'location_attach';
	
    function __construct()
    {
        parent::__construct();
        $this->load->helper('alert');
//         $this->mem_id = $this->session->userdata['mem_id'];
    }

    
    
    function get_list($type = '', $offset = '', $limit = '', $search_word = '')
    {
    	$sword = ' WHERE 1 = 1 ';
    
    	if ( $search_word != '' )
    	{
    		//검색어가 있을 경우의 처리
    		$sword = ' WHERE title like "%'.$search_word.'%" or introduce like "%'.$search_word.'%" ';
    	}
    
    	$limit_query = '';
    
    	if ( $limit != '' OR $offset != '' )
    	{
    		//페이징이 있을 경우의 처리
    		$limit_query = ' LIMIT '.$offset.', '.$limit;
    	}
    
    	$sql = "SELECT * FROM ".$this->lo_table.$sword." ORDER BY id DESC".$limit_query;
    	$query = $this->db->query($sql);
    
    	if ( $type == 'count' )
    	{
    		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
    		$result = $query->num_rows();
    
    		//$this->db->count_all($table);
    	}
    	else
    	{
    		//게시물 리스트 반환
    		$result = $query->result();
    		
    		//게시물 섬네일파일을 구함
    		foreach($result as $key => $value){
    			
    			$sql = "SELECT attach_name FROM ".$this->lo_attach_table." WHERE lo_id = ".intval($value->id)." ORDER BY rand() LIMIT 1";
    			$query = $this->db->query($sql);
    			$_result = $query->row();
    			
    			
    			$result[$key]->thumbnail = $_result->attach_name;
    		}
    	}
    
    	return $result;
    }
    
 	
   /**
	 * 게시물 상세보기 가져오기
	 */
    function get_view($id = 0)
    {
        
    	//조회수 증가
    	$sql = "UPDATE ".$this->lo_table." SET hits = hits + 1 WHERE id = ".$id;
   		$this->db->query($sql);

   		$sql = "SELECT * FROM ".$this->lo_table." WHERE id = ".$id;
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }
    
    
    /**
     * 게시물 첨부사진 가져오기
     */
    function get_attachs($id = 0){
        $sql = "SELECT attach_name FROM ".$this->lo_attach_table." WHERE lo_id = ".$id;
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    
 	
}

