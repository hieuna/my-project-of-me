<?
/*
dinhtoan1905
*/
require_once 'reader.php';
class importExcel{
	//arrayFeld key la thu tu cot trong bang excel con value la truong de update tuong ung
	var $arrayFeld		= array(1=>array("pro_id",1)
							   //,2=>array("pro_name",0)
							   ,3=>array("pro_price",3)
								//,4=>array("pro_pricesale",3)
								//,5=>array("pro_decreaseprice",3)
							   ,4=>array("pro_stock",1)
							  );
						  
	var $arrayType		= array(0=>"VARCHAR( 255 ) NULL ,"
								,1=>"INT( 11 ) NULL DEFAULT '0',"
								,3=>"DOUBLE NULL DEFAULT '0',"
								);
	var $common_error 	= '';						  
	var $arrayRecord	= array();
	var $colRecordId	= 1;
	var $table			= 'products';
	
	function importExcel($upload_name,$arrayFeld=array()){
		if(count($arrayFeld)>1) $this->arrayFeld = $arrayFeld;
		//print_r($this->arrayFeld); exit();
		// kiem tra xem co upload ko
		if (!is_uploaded_file($_FILES[$upload_name]['tmp_name'])){
			$this->common_error = "Không tìm thấy file tmp_name, file upload tạm<br>";
			return;
		}
		//generate new filename
		$data = new Spreadsheet_Excel_Reader();
		// Set output Encoding.
		$data->setOutputEncoding('UTF-8');
		$data->setUTFEncoder('mb');
		$a = $data->read($_FILES[$upload_name]['tmp_name']);
		error_reporting(E_ALL ^ E_NOTICE);
		$arayDuplicate = array();
		// lap tung sheet mot
		for($she=0;$she<count($data->sheets);$she++){
			$total_record=$data->sheets[$she]['numRows'];
			//xem tung record trong tung sheet
			for($i=0;$i<=$total_record;$i++){
				//mac dinh truong id se la cot dau tien
				$record_id = '';
				if(isset($data->sheets[$she]['cells'][$i][$this->colRecordId])) $record_id = intval(RemoveSign($data->sheets[$she]['cells'][$i][$this->colRecordId]));
				$stt = 0;
				
				foreach($this->arrayFeld as $key=>$value){
					$fieldvalue = '';
					if(isset($data->sheets[$she]['cells'][$i][$key])){
						 $fieldvalue = trim($data->sheets[$she]['cells'][$i][$key]);
					}
					
					//kiem tra kieu du lieu dinh nghia tu array
					switch($value[1]){
						case 0:
							$fieldvalue = str_replace("\'","'",$fieldvalue);
							$fieldvalue = str_replace("'","''",$fieldvalue);
							$fieldvalue = htmlspecialchars($fieldvalue);
							//$fieldvalue = str_replace("'","",$fieldvalue);
							//$fieldvalue	= html_entity_decode($fieldvalue, ENT_NOQUOTES, "UTF-8");
							$fieldvalue = "'" . ($fieldvalue) . "'";
						break;
						case 1:
							$fieldvalue = intval(trim($fieldvalue));
						break;
						case 3:
							$fieldvalue = doubleval($fieldvalue);
						break;
						
					}
					
					//gan vao mang
						$arrayRecord[$record_id][$stt] = $fieldvalue;
						$stt++;
				}				
			}
		}
		//tao bang temp de nho tam thoi
		//CREATE temporary TABLE `temp_updateprice`
		$sql = 'CREATE TABLE `temp_updateprice` (';
		foreach($this->arrayFeld as $key=>$value){
			$sql .= 't' . $value[0] . ' ' . $this->arrayType[$value[1]];
		}
		$sql .= 'PRIMARY KEY ( t' . $this->arrayFeld[$this->colRecordId][0] . ' )) ENGINE = InnoDB';
		
		//xoa bang temp neu ton tai
		$db_deletetemp =  new db_execute("DROP TABLE IF EXISTS temp_updateprice");
		unset($db_deletetemp);
		//echo $sql . '<br>';
		//tao moi bang
		$db_create =  new db_execute($sql);
		unset($db_create);
		//tao cau lenh query de insert vào database
		$sql = 'REPLACE INTO temp_updateprice VALUES ';
		$r = 0;
		$countrow = count($arrayRecord);
		$countfield = count($this->arrayFeld);
		foreach($arrayRecord as $id=>$lvalue){
			$checkid = mb_strtolower($id,"UTF-8");
			if($id != '' && !isset($arayDuplicate[$checkid])){
				$arayDuplicate[$checkid] = '';
				$sql .= '(';
				$i=0;
				foreach($this->arrayFeld as $key=>$value){
					$sql .= $lvalue[$i];
					$i++;
					if($i<$countfield) $sql .= ',';
				}
				$sql .= ')';
				$r++;
				$sql .= ',';
			}
		}
		$sql = mb_substr($sql, 0, mb_strlen($sql,"UTF-8")-1,"UTF-8");
		//xem query insert
		//echo  $sql . '<br>';
		//insert vao bang temp
		$db_create =  new db_execute($sql);
		unset($db_create);
		//exit();
		//phan update tu bang temp sang bang can update
		
		$sql = "UPDATE temp_updateprice AS a, " . $this->table . " AS b
				SET ";
				
		$i=1;
		foreach($this->arrayFeld as $key=>$value){
			if($key != $this->colRecordId){
				$sql .= ' b.' . $value[0] . '=a.t' . $value[0];
			}
			if($i<$countfield && $key != $this->colRecordId) $sql .= ',';
			$i++;
		}
		$sql .= " WHERE b." . $this->arrayFeld[$this->colRecordId][0] . '=' . 'a.t' . $this->arrayFeld[$this->colRecordId][0];
		//echo $sql;
		//thuc thi cau lenh update giua hai bang voi nhau
		$db_create =  new db_execute($sql);
		unset($db_create);
		//print_r($arrayRecord);
	}
}
?>