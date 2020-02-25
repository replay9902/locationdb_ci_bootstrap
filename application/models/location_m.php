<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Location_m extends My_Model
{
	
	var $lo_table = 'location';
	var $lo_attach_table = 'location_attach';
	var $search_history_table = 'search_history';
	
    function __construct()
    {
        parent::__construct();
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
    			
    			$this->db->select('attach_name');
    			$this->db->where(array('lo_id' => intval($value->id)));
    			$this->db->order_by('title', 'RANDOM');
    			$query = $this->db->get($this->lo_attach_table, 1);
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
   		$this->db->set('hits', 'hits + 1', false);
   		$this->db->where(array('id' => $id));
   		$this->db->update($this->lo_table);
   		
   		$query = $this->db->get_where($this->lo_table, array('id' => $id), 1);
	    $result = $query->row();
        //echo $this->db->last_query();
    	return $result;
    }
    
    
    /**
     * 게시물 첨부사진 가져오기
     */
    function get_attachs($id = 0){
        
        $this->db->select('attach_name');
        $query = $this->db->get_where($this->lo_attach_table, array('lo_id' => $id));
        $result = $query->result();
        //echo  $this->db->last_query();
        return $result;
    }

    
    function get_locations(){
    	$this->db->select('location');
    	$this->db->group_by('location');
    	$this->db->order_by('location', 'ASC');
    	$query = $this->db->get($this->lo_table);
    	$result = $query->result();
    	return $result;
    }
    
    /**
     * 검색 키워드 이력 저장
     * @param string $keyword
     */
    function search_history_enroll($keyword = ''){
        
        if($keyword == '') return;
        
        $query = $this->db->get_where($this->search_history_table, array('keyword' => $keyword));
        $count = $query->num_rows();
        
        if($count){
           
            $this->db->set('count', 'count + 1', false);
            $this->db->where(array('keyword' => $keyword));
            $this->db->update($this->search_history_table);
            
        }else{
            
            $data = array(
                'keyword' => $keyword,
                'count' => 1,
                'ip' => $this->input->server('REMOTE_ADDR')
            );
            $this->db->set('regdate', 'NOW()', false);
            $this->db->insert($this->search_history_table, $data);
        }
        
    }
 	
    
    public function naver_map_geocode($address = '', $id = 0){
        
        $ch = curl_init();
        $header = array(
            "X-NCP-APIGW-API-KEY-ID:".NAVER_MAP_CLIENTID,
            "X-NCP-APIGW-API-KEY:".NAVER_MAP_CLIENTSECRET,
        );
        curl_setopt($ch, CURLOPT_URL, "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode?query=".$address);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
        $result = curl_exec($ch);
        $buffer = ob_get_contents();
        ob_end_clean();
        $data = json_decode($buffer);
        
        $lat = $data->addresses[0]->y;
        $lng = $data->addresses[0]->x;
        $roadAddress = $data->addresses[0]->roadAddress;
        $latlng = $lat.",".$lng;
        
		$this->db->set('latlng', $latlng);
		$this->db->where(array('id' => $id));
		$this->db->update($this->lo_table);
		
    }
    
}

