<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//메세지 출력 후 이동
function auto_phone_number_hyphen($str = '') 
{
	$str = preg_replace('/[^0-9]/i', '', $str);
	
	$len = strlen($str);
	$rtn_str = "";
	
	if($len < 4){
		$rtn_str = $str;
	}else if($len < 7){
		
		$rtn_str .= substr($str, 0, 3);
		$rtn_str .= "-";
		$rtn_str .= substr($str, 3);
		
	}else if($len < 11){
		
		if(substr($str, 0, 2) == "02"){
			
			$rtn_str .= substr($str, 0, 2);
			$rtn_str .= "-";
			$rtn_str .= substr($str, 2, 4);
			$rtn_str .= "-";
			$rtn_str .= substr($str, 6);
			
		}else{
			
			$rtn_str .= substr($str, 0, 3);
			$rtn_str .= "-";
			$rtn_str .= substr($str, 3, 3);
			$rtn_str .= "-";
			$rtn_str .= substr($str, 6);
		}
		
	}else{
		$rtn_str .= substr($str, 0, 3);
		$rtn_str .= "-";
		$rtn_str .= substr($str, 3, 4);
		$rtn_str .= "-";
		$rtn_str .= substr($str, 7);
	}
	
	echo $rtn_str;
}
