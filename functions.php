<?php
	function pa($array, $return = ""){
		if( !$return ){
			echo '<pre>'.print_r($array,true).'</pre>';
		}else{
			return '<pre>'.print_r($array,true).'</pre>';
		}
	}
	
	function doCurl($URL){
		//Initialize cURL.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // Skip SSL Verification

		$data = curl_exec($ch);
		 
		//Close the cURL handle.
		curl_close($ch);
		
		return $data;
	}
?>