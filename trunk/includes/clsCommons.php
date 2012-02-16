<?php
class clsCommons
{
	function fns_IsImage($str)
	{
		if(strpos($str,".")<=0) return false;
		$str=substr($str,strpos($str,".")+1);
		if($str=='jpg' || $str=='bmp' || $str=='jpeg' || $str=='png' || $str=='gif') return true;
		else return false;
	}


	
	/*
	function fns_Save($str){
		if(get_magic_quotes_gpc()) 
			return stripslashes($str);
		else 
			return mysql_real_escape_string($str);
	}
	*/
	function fns_Save($str){
		return mysql_real_escape_string($str);
	}
	
	/*
		fns_IsRecord($sql): Xem co ton tai 1 Record khong
		Input: 	$sql
		Output:	true/false
	*/
	function fns_IsRecord($sql){
		$result=mysql_query($sql) or die("Not query fns_IsRecord");
		if(mysql_num_rows($result)) return true;
		else return false;
	}
	
	
	/*
		fns_Rows($sql): Mang cac Records
		Input:	$sql
		Output:	Rows
	*/
	function fns_Rows($sql){
		$result=mysql_query($sql) or die("Not query fns_Rows");
		$rows=array();
		while($r=mysql_fetch_array($result)){
			$rows[]=$r;
		}
		return $rows;
	}
		
	/*
		fns_Rows($sql,$Field): Mang cac Records
		Input:	$sql
		Output:	Rows
	*/
	function fns_RowsField($sql,$Field)
	{
		$result=mysql_query($sql) or die("Not query fns_Rows");
		$rows=array();
		while($r=mysql_fetch_array($result))
		{
			$rows[]=$r[$Field];
		}
		return $rows;
	}
	/*-----------------------------------------------------------------------------*/
	
	
	/*
		fns_TotalRows($sql): Tong so Records
		Input:	$sql
		Output:	TotalRows
	*/
	function fns_TotalRows($sql)
	{
		$result=mysql_query($sql) or die("Not query fns_TotalRows");
		$total=mysql_num_rows($result);
		return $total;
	}
	/*-----------------------------------------------------------------------------*/
	
	/*
	
		fns_FormatDate($date): Chuyen date dang dd-mm-YYYY --> YYY-mm-yy
	*/
	
	function fns_FormatDate($date)
	{
		$str=$date;
		$i=strpos($str,'-');
		$dd=substr($str,0,$i);
		
		$str=substr($str,$i+1);
		$i=strpos($str,'-');
		$mm=substr($str,0,$i);
		
		$YYYY=substr($str,$i+1);

		/*	
		echo "dd: $dd <br>";
		echo "mm: $mm <br>";
		echo "YYYY: $YYYY <br>";
		*/
		$str=$YYYY."-".$mm."-".$dd;
		
		//echo $str;
		
		return $str;
		
	}
	
	function fns_Rand_digit($min,$max,$num)
	{
		$result='';
		for($i=0;$i<$num;$i++){
			$result.=rand($min,$max);
		}
		return $result;	
	}
	
	/*
	function fns_Is_Date_VN(strDate){
		return true;
	}
		
	function fns_Is_Date_EN(strDate){
		return true;
	}
	
	function fns_Convert_Date_VN_EN(strDate){
		return true;
	}	
	*/
	
	
	function fns_Format_Date_English($strDate){
		$str = strtok($strDate,"-");
		$day = $str;	
		$str = strtok("-");
		$month = $str;
		$str = strtok("-");
		$year = $str;
		return ($year."-".$month."-".$day);
	}

	
	/*Ngay hom truoc*/
	function fns_date_befor($strDate){
		if (ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$strDate,$regs)) {
			$day = (int)($regs[1]);
			$month = (int)($regs[2]);
			$year = (int)($regs[3]);
		}	
		//Ngay hom truoc
		if ($day != 1) {
			$day--;		
		}
		else {		
			if ($month==1) {
				$day=31;
				$month=12;
				$year--;			
			}		
			elseif ($month==3) {
				$tg = $year%4;
				$tg1 = $year%100;			
				$tg2 = $year%400;					
				if(!($tg==0 && ($tg1!=0 || $tg2==0))) {
					$day=28;				
				}
				else {
					$day=29;								
				}
				$month=2;
			}
			elseif (ereg("[2,4,6,8,9,11]",$month)) {
				$day=31;
				$month--;
			}		
			elseif (ereg("[5,7,10,12]",$month)) {
				$day=30;
				$month--;
			}		
		}
		return  $day."-".$month."-".$year;
	}
	
	/*1 tuan truoc*/
	function fns_week_befor($strDate){
		if (ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$strDate,$regs)) {
			$day = (int)($regs[1]);
			$month = (int)($regs[2]);
			$year = (int)($regs[3]);
		}	
		//tuan truoc
		if (day>7)	{
			$day = $day -7;
		}
		else {
			if ($month==1) {	
				$day = 31 + $day -7;
				$month = 12;
				$year--;
			}
			elseif ($month==3) {
				$tg = $year%4;
				$tg1 = $year%100;
				$tg2 = $year%400;	
				if(!($tg==0 && ($tg1!=0 || $tg2==0))) {
					$day=28 + $day - 7;
				}
				else {
					$day=29 + $day - 7;
				}
				$month=2;
			}
			elseif (ereg("[2,4,6,8,9,11]",$month)) {
				$day=31 + $day - 7;
				$month--;
			}
			elseif (ereg("[5,7,10,12]",$month)) {
				$day=30 + $day - 7;
				$month--;
			}				
		}
		return  $day."-".$month."-".$year;
	}
	
	/*1 thang truoc */
	function fns_month_befor($strDate){
		if (ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$strDate,$regs)) {
			$day = (int)($regs[1]);
			$month = (int)($regs[2]);
			$year = (int)($regs[3]);
		}	
		if ($month==1) {	
			$month = 12;
			$year--;
			return  $day."-".$month."-".$year;		
		}			
		if ($month==3) {		
			if ($day>28) {			
				$tg = $year%4;
				$tg1 = $year%100;
				$tg2 = $year%400;	
				if(!($tg==0 && ($tg1!=0 || $tg2==0))) {
					$day=28;
				}
				else {
					$day=29;
				}
			}
			$month--;
			return  $day."-".$month."-".$year;
		}
		if (ereg("[2,4,6,8,9,11]",$month)) {
			$month--;
			return  $day."-".$month."-".$year;
		}
		if (ereg("[5,7,10,12]",$month)) {
			if ($day==31) {
				$day=30;
			}
			$month--;	
			return  $day."-".$month."-".$year;		
		}		
	}
	
	/*1 nam truoc */
	function fns_year_befor($strDate){
		if (ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$strDate,$regs)) {
			$day = (int)($regs[1]);
			$month = (int)($regs[2]);
			$year = (int)($regs[3]);
		}	
		if ($month==2 && $day>27) {		
			$tg = ($year-1)%4;
			$tg1 = ($year-1)%100;
			$tg2 = ($year-1)%400;	
			if(!($tg==0 && ($tg1!=0 || $tg2==0))) {
				$day=28;
			}
			else {
				$day=29;
			}		
		}
		$year--;
		return  $day."-".$month."-".$year;	
	}
	
	
	function fns_FomatPrice($strPrice) {
	$strPrice = trim($strPrice);
	$j = (strlen($strPrice)-(strlen($strPrice)%3))/3;				
	for($i=1;$i<=$j;$i++) {
		$strPrice=substr_replace($strPrice,'.',(strlen($strPrice)-$i*3-$i+1),0);
	}
	if($strPrice[0]=='.') {
		$strPrice=substr($strPrice,1);
	}
	return $strPrice;
}
	
	function fns_AfterDay($strDate,$NumberDay) {
		$strDate = trim($strDate);
		$NumberDay = trim($NumberDay);
		//tach ngay thang nam
		if (ereg("([0-9]{1,2})-([0-9]{1,2})-([0-9]{4})",$strDate,$regs)) {
			$day = (int)($regs[1]);
			$month = (int)($regs[2]);
			$year = (int)($regs[3]);
		}	
		//tao mang so ngay cac thang cua nam 
		$array_month = array(31,29,31,30,31,30,31,31,30,31,30,31);	
		$tg = $year%4;
		$tg1 = $year%100;
		$tg2 = $year%400;	
		if(!($tg==0 && ($tg1!=0 || $tg2==0))) {
			$array_month[1]=28;
		}
		
		//after n days
		$day = $day + $NumberDay;
		if($month==12) {
			if($day>31) {
				$day=$day-31;
				$month=1;
				$year++;
			}
		}
		else {
			while($day>$array_month[$month-1]) {
				$day=$day-$array_month[$month-1];
				$month++;
			}
		}
		return $day."-".$month."-".$year;		
	}
	
	
	function fns_Separate($lsX,$lsY)
	{
		$x=strpos($lsX,$lsY,1)+strlen($lsY)+1;
		$y=strpos($lsX,"(",$x-1);
		return substr($lsX,$x,$y-$x-1);
	}

	function fns_unUnicode($str)
	{
		$str = trim($str);	
		//chuyen thanh a
		$str_array = array("?","?","�","�","�","�","?","?","�","�","�","�","?","?","?","?","?","?","?","?","?","?","a","A","?","?","?","?","?","?","?","?","?","?");
		$str = str_replace($str_array,"a",$str);
		//chuyen thanh i
		$str_array = array("?","?","�","�","�","�","?","?","i","I");
		$str = str_replace($str_array,"i",$str);
		//chuyen thanh d
		$str_array = array("d","�");
		$str = str_replace($str_array,"d",$str);
		//chuyen thanh o
		$str_array = array("?","?","�","�","�","�","?","?","�","�","�","�","?","?","?","?","?","?","?","?","?","?","o","O","?","?","?","?","?","?","?","?","?","?");
		$str = str_replace($str_array,"o",$str);
		//chuyen thanh e
		$str_array = array("?","?","�","�","?","?","?","?","�","�","?","?","?","?","?","?","?","?");
		$str = str_replace($str_array,"e",$str);
		//chuyen thanh u
		$str_array = array("?","?","�","�","�","�","?","?","u","U","u","U","?","?","?","?","?","?","?","?","?","?");
		$str = str_replace($str_array,"u",$str);
		//chuyen thanh y
		$str_array = array("?","�","?","?","?","?","�","?","?","?");
		$str = str_replace($str_array,"y",$str);
		//chuyen thanh -	
		$str_array = array("!","@","#","$","%","^","&","*","+","=","|",".","<",">","?","/");
		$str = str_replace($str_array,"-",$str);
		
		return strtolower($str);	
	}

}


?>