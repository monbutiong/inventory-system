<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

if (! function_exists('fm')) {

    function fm($ser,$arr = [],$custom_field = ''){
      
      $pos = array_search($ser, $arr);

      if($custom_field){ 

      	if(@$arr[$pos]->{$custom_field}){
      	 
      		return $arr[$pos]->{$custom_field};

      	}else{

	        return '-';
	      }

      }else{

      	if(@$arr[$pos]->title){
      	 
      		return $arr[$pos]->title;

      	}else{

	        return '-';
	      
        }
	    
  	  } 

    }

}

if (! function_exists('fstat')) {
	function fstatx($v = ''){
		if($v == 0){
			$v = 'Pending';
		}elseif($v == 1){
			$v = 'Approved';
		}elseif($v == 2){
			$v = 'Rejected';
		}elseif($v == 3){
			$v = 'Cancel';
		}
		return $v;
	}
}

if (! function_exists('fpost')) {
	function fpost($v){
		return trim(@$_POST[$v]);   
	}
}

if (! function_exists('vpost')) {
	function vrequire($av=[]){

		$success = 1;

		foreach ($av as $value) {
			if(!@$_POST[$value]){
				$success = 0;
			}
		} 

		return $success;   
	}
}
 


