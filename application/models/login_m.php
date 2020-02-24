<?
class Login_m extends My_Model {

	var $memberTable = "memberinfo";
	
    function __construct()
    {
        parent::__construct();

    }

    function do_login(){

		$uid = $_POST['mem_id'];
		$pwd = $_POST['mem_pw'];
		
		$query = "SELECT * FROM ".$this->memberTable." WHERE mem_id = ? AND mem_pw = password(?)";
		$stm = array($uid, $pwd);
		$result = $this->db->query($query, $stm);
		$row = $result->row_array();
		
		if(count($row) > 0){
			return $row;
		}else
		{
			return null;
		}
		
	}
    
	
	function logindate_update($mem_id = ''){
		
		$dt = date("Y-m-d H:i:s");
			
		$modify_array = array(
				'mem_login_dt' => $dt
		);
		
		$where = array(
				'mem_id' => $mem_id
		);
		
		$result = $this->db->update($this->memberTable, $modify_array, $where);
		
	}
	
}

?>
