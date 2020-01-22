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

    
    
    function get_list($type = '', $offset = '', $limit = '', $search_word = '', $location = '')
    {
    	
    	
    
    	if ($search_word != '')
    	{
    		//검색어가 있을 경우의 처리
    		$this->db->or_like('title', $search_word);
    		$this->db->or_like('introduce', $search_word);
    	}
    
    	if($location != ""){
    		$this->db->where('location', $location);
    	}
    	
    	$limit_query = '';
    
    	if ( $limit != '' OR $offset != '' )
    	{
    		//페이징이 있을 경우의 처리
    		$this->db->limit($limit, $offset);
    	}
    	
    	$this->db->order_by('id', 'DESC');
    
    	$query = $this->db->get($this->lo_table);
//     	echo $this->db->last_query();
    
    	if ( $type == 'count' )
    	{
    		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
    		$result = $query->num_rows();
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
   		
   		$query = $this->db->get_where($this->lo_table, array('id' => $id), 1);
	    $result = $query->row();
//    		echo $this->db->last_query();


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

    
    function get_locations(){
    	$sql = "SELECT location FROM ".$this->lo_table." GROUP BY location ORDER BY location ASC";
    	$query = $this->db->query($sql);
    	$result = $query->result();
    	return $result;
    }
    
 	
}

