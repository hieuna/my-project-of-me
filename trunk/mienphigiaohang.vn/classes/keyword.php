<?
class replace_keyword{
	
	var $store_string		= "";
	var $array_keyword	= array();
	var $array_break		= array("\n", "||");
	
	/*
	Function khởi tạo
	*/
	function replace_keyword($string, $keyword){
		
		$this->store_string = replaceFCK($string, 1);
		
		$arrKeyword	= explode($this->array_break[0], $keyword);
		for($i=0; $i<count($arrKeyword); $i++){
			$arrTemp	= explode($this->array_break[1], $arrKeyword[$i]);
			if(count($arrTemp) == 2){
				$this->array_keyword[$arrTemp[0]] = $arrTemp[1];
			}
		}
		
		//print_r($this->array_keyword);
		
	}
	
	/*
	Function replace_description
	*/
	function replace_description(){
		
		foreach($this->array_keyword as $key => $value){
			$strRep = '<a class="text_link" href="' . $value . '">' . $key . '</a>';
			$this->store_string = str_ireplace($key, $strRep, $this->store_string);
		}
		
		return $this->store_string;
		
	}
	
}
?>