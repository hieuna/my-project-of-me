<?
function getDateTime($language="vn", $getDay=1, $getDate=1, $getTime=1, $timeZone="GMT+7", $intTimestamp=0){
	if($intTimestamp > 0){
		$today	= getdate($intTimestamp);
		$day		= $today["wday"];
		$date		= date("d/m/Y", $intTimestamp);
		$time		= date("H:i", $intTimestamp);
	}
	else{
		$today	= getdate();
		$day		= $today["wday"];
		$date		= date("d/m/Y");
		$time		= date("h:i");
	}
	switch($language){
		case "vn": $dayArray = array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"); break;
		case "en": $dayArray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"); break;
		default	: $dayArray = array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"); break;
	}
	$strDateTime = "";
	for($i=0; $i<=6; $i++){
		if($i == $day){
			if($getDay	!= 0)	$strDateTime .= $dayArray[$i] . ", ";
			if($getDate	!= 0)	$strDateTime .= $date . " | ";
			if($getTime	!= 0)	$strDateTime .= $time . " ";
			$strDateTime .= $timeZone;
			if(substr($strDateTime, -2, 2) == ", ") $strDateTime = substr($strDateTime, 0, -2);
			return $strDateTime;
		}
	}
}
?>
<?
function convertDateTime($strDate = "", $strTime = ""){
	//Break string and create array date time
	$strDate			= str_replace("/", "-", $strDate);
	$strDateArray		= explode("-", $strDate);
	$countDateArr		= count($strDateArray);
	$strTime			= str_replace("-", ":", $strTime);
	$strTimeArray	= explode(":", $strTime);
	$countTimeArr	= count($strTimeArray);
	//Get Current date time
	$today			= getdate();
	$day				= $today["mday"];
	$mon				= $today["mon"];
	$year				= $today["year"];
	$hour				= $today["hours"];
	$min				= $today["minutes"];
	$sec				= $today["seconds"];
	//Get date array
	switch($countDateArr){
		case 2:
			$day	= intval($strDateArray[0]);
			$mon	= intval($strDateArray[1]);
			break;
		case $countDateArr >= 3:
			$day	= intval($strDateArray[0]);
			$mon	= intval($strDateArray[1]);
			$year = intval($strDateArray[2]);
			break;
	}
	//Get time array
	switch($countTimeArr){
		case 2:
			$hour	= intval($strTimeArray[0]);
			$min	= intval($strTimeArray[1]);
			break;
		case $countTimeArr >= 3:
			$hour	= intval($strTimeArray[0]);
			$min	= intval($strTimeArray[1]);
			$sec	= intval($strTimeArray[2]);
			break;
	}
	//Return date time integer
	if(@mktime($hour, $min, $sec, $mon, $day, $year) == -1) return $today[0];
	else return mktime($hour, $min, $sec, $mon, $day, $year);
}
?>
<?
function DatetoInt($day,$month,$year,$hour=0,$min=0,$second=0){
	return mktime($hour,$min,$second,$month,$day,$year);
}
function getDay($intdate){
	return date("d",$intdate);
}
function getMonth($intdate){
	return date("m",$intdate);
}
function getYear($intdate){
	return date("Y",$intdate);
}
function getShortDate($intdate){
	return getDay($intdate) . "/" . getMonth($intdate) . "/" . getYear($intdate);
}
?>
<?
function validateDate($strDate){
	$strDate = str_replace("/","-",$strDate);
	$strDateArray = explode("-",$strDate);
	if (count($strDateArray) == 3){
		if (checkdate(intval($strDateArray[1]), intval($strDateArray[0]), intval($strDateArray[2]))){
			return "1";
		}
		else{
			return "0";
		}
	}
	else{
		return "0";
	}
}
?>
<?
function convertDatetomySQL($strDate){
	$strDate = str_replace("/","-",$strDate);
	$strDateArray = explode("-",$strDate);
	return $strDateArray[2] . "-" . $strDateArray[1] . "-" . $strDateArray[0];
}
?>
<?
function convertDatefrommySQL($strDate){
	$strDate = str_replace("/","-",$strDate);
	$strDateArray = explode("-",$strDate);
	return $strDateArray[2] . "-" . $strDateArray[1] . "-" . $strDateArray[0];
}
?>