<?
function convertDateTime($strDate = "", $strTime = ""){
	//Break string and create array date time
	$array_replace	= array("/", ":");
	$strDate		= str_replace($array_replace, "-", $strDate);
	$strTime		= str_replace($array_replace, "-", $strTime);
	$strDateArray	= explode("-", $strDate);
	$strTimeArray	= explode("-", $strTime);
	$countDateArr	= count($strDateArray);
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
			if(intval($strDateArray[1]) > 12)
			{
				$day	= intval($strDateArray[1]);
				$mon	= intval($strDateArray[0]);
			}else
			{
				$day		= intval($strDateArray[0]);
				$mon		= intval($strDateArray[1]);
			}
			break;
			
		case $countDateArr >= 3:
			if(intval($strDateArray[1]) > 12)
			{
				$day		= intval($strDateArray[1]);
				$mon		= intval($strDateArray[0]);
				$year 		= intval($strDateArray[2]);
			}else
			{
				$day		= intval($strDateArray[0]);
				$mon		= intval($strDateArray[1]);
				$year 		= intval($strDateArray[2]);
			}
			break;
	}
	//Get time array
	switch($countTimeArr){
		case 2:
			$hour		= intval($strTimeArray[0]);
			$min		= intval($strTimeArray[1]);
			break;
		case $countTimeArr >= 3:
			$hour		= intval($strTimeArray[0]);
			$min		= intval($strTimeArray[1]);
			$sec		= intval($strTimeArray[2]);
			break;
	}
	//Return date time integer
	if(@mktime($hour, $min, $sec, $mon, $day, $year) == -1) return $today[0];
	else return mktime($hour, $min, $sec, $mon, $day, $year);
}
?>
<?
function convertDateFromDB($date, $sep="-"){
	$arrDate		= explode("-", $date);
	$strReturn	= "";
	if(count($arrDate) == 3){
		$strReturn	= $arrDate[2] . $sep . $arrDate[1] . $sep . $arrDate[0];
	}
	return $strReturn;
}
?>
<?
function getDateTime($language=1, $getDay=1, $getDate=1, $getTime=1, $timeZone="GMT+7", $intTimestamp=0){
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
		case 1: $dayArray = array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"); break;
		case 2: $dayArray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"); break;
		default:$dayArray = array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"); break;
	}
	$strDateTime = "";
	for($i=0; $i<=6; $i++){
		if($i == $day){
			if($getDay	!= 0)	$strDateTime .= $dayArray[$i] . ", ";
			if($getDate	!= 0)	$strDateTime .= $date . ", ";
			if($getTime	!= 0)	$strDateTime .= $time . " ";
			$strDateTime .= $timeZone;
			if(substr($strDateTime, -2, 2) == ", ") $strDateTime = substr($strDateTime, 0, -2);
			return $strDateTime;
		}
	}
}
?>
<?
function today_yesterday($td_day, $td_month, $td_year, $ye_day, $ye_month, $ye_year, $compare_time){
	$ct = getdate($compare_time);
	//Kiểm tra so với hôm nay
	if($td_day==$ct["mday"] && $td_month==$ct["month"] && $td_year==$ct["year"]) return tdt("Hom_nay,_luc") . " " . date("H:i", $compare_time) . " GMT-6";
	if($ye_day==$ct["mday"] && $ye_month==$ct["month"] && $ye_year==$ct["year"]) return tdt("Hom_qua,_luc") . " " . date("H:i", $compare_time) . " GMT-6";
	//Nếu không trùng thì return lại
	return date("d/m/Y - H:i",$compare_time) . " GMT-6";
}
?>
<?
function validateDate($strDate){
	$strDate			= str_replace("/","-",$strDate);
	$strDateArray	= explode("-",$strDate);
	$countDateArr	= count($strDateArray);
	if($countDateArr == 3){
		if(checkdate(intval($strDateArray[1]), intval($strDateArray[0]), intval($strDateArray[2]))) return 1;
		else return 0;
	}
	else return 0;
}
?>
<?
function array_date($min, $max){
	$arrReturn	= array();
	if($min == $max){
		$arrReturn[] = array(date("m", $min), date("Y", $min));
	}
	else{
		$minM	= date("m", $min);
		$minY	= date("Y", $min);
		$maxM	= date("m", $max);
		$maxY	= date("Y", $max);
		$minDateStr	= "01/" . $minM . "/" . $minY;
		$maxDateStr	= "01/" . $maxM . "/" . $maxY;
		$minDateInt	= convertDateTime($minDateStr, "00:00:00") + 1296000;
		$maxDateInt	= convertDateTime($maxDateStr, "00:00:00") + 1296000;
		
		for($i=$minDateInt; $i<=$maxDateInt; $i+=2419200){
			$arrReturn[] = array(date("m", $i), date("Y", $i));
		}
	}
	//print_r($arrReturn);
	return $arrReturn;
}
?>
<?
function get_start_end_month($month, $year){
	$array_return = array();
	for($i=31; $i>=28; $i--){
		if(checkdate($month, $i, $year)){
			$array_return["start"]	= convertDateTime("01/" . $month . "/" . $year, "00:00:00");
			$array_return["end"]		= convertDateTime($i . "/" . $month . "/" . $year, "23:59:59");
			break;
		}
	}
	return($array_return);
}
?>

<?
function secondstowords($seconds)
{
    /*** return value ***/
    $return = "";
    $minutes = 0;
    $hours = 0;
    /*** get the hours ***/
    $hours = intval(intval($seconds) / 3600);
    if($hours > 0)
    {
        $return .= $hours . " giờ ";
    }
    
    /*** get the minutes ***/
    
	
    if($hours > 0)
    {
		$minutes = intval(($seconds - ($hours * 3600)) / 60);
        $return .= $minutes . " phút ";
    }
  
    /*** get the seconds ***/
    $seconds = $seconds - ($minutes * 60) - ($hours * 3600);
    $return .= $seconds . " giây";

    return $return;
}
?>
<?

function TimeTo($future) // $original should be the future date and time in unix format
{                                                                                      
    // Common time periods as an array of arrays

    $periods = array(

        array(60 * 60 * 24 * 365 , 'year'),

        array(60 * 60 * 24 * 30 , 'month'),

        array(60 * 60 * 24 * 7, 'week'),

        array(60 * 60 * 24 , 'day'),

        array(60 * 60 , 'hour'),

        array(60 , 'minute'),

    );

   

    $today = time();

    $since = $future - $today; // Find the difference of time between now and the future

   

    // Loop around the periods, starting with the biggest

    for ($i = 0, $j = count($periods); $i < $j; $i++)

        {

        $seconds = $periods[$i][0];

        $name = $periods[$i][1];

       

        // Find the biggest whole period

        if (($count = floor($since / $seconds)) != 0)

                {

            break;

        }

    }

   

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";

   

    if ($i + 1 < $j)

        {

        // Retrieving the second relevant period

        $seconds2 = $periods[$i + 1][0];

        $name2 = $periods[$i + 1][1];

       

        // Only show it if it's greater than 0

        if (($count2 = floor(($since - ($seconds * $count)) / $seconds2)) != 0)

                {

            $print .= ($count2 == 1) ? ', 1 '.$name2 : ", $count2 {$name2}s";

        }

    }

    return $print;

}
?>
<?
function generate_calendar_cucre($month, $year){
	global $root_path;
	$month	= intval($month);
	$year		= intval($year);
	
	$db_date	= new db_query("SELECT pha_end_time
									FROM phagia
								 	WHERE DATE_FORMAT(FROM_UNIXTIME(pha_end_time), '%c') = " . $month . " AND DATE_FORMAT(FROM_UNIXTIME(pha_end_time), '%Y') = " . $year . " AND pha_active = 1
								 	ORDER BY pha_end_time DESC
								 	LIMIT 1");
	$end_date_has_cucre = 0;
	if(mysql_num_rows($db_date->result) > 0){
		$row_date = mysql_fetch_assoc($db_date->result);
		$end_date_has_cucre = date("d",$row_date["pha_end_time"]);
	}
	unset($db_date);
	
	$arrDay	= array('T 2', 'T 3', 'T 4', 'T 5', 'T 6', 'T 7', 'CN');
	$arrMonth			= array ("1"		=> "January",
										 "2"		=> "February",
										 "3"		=> "March",
										 "4"		=> "April",
										 "5"		=> "May",
										 "6"		=> "June ",
										 "7"		=> "July",
										 "8"		=> "August",
										 "9"		=> "September",
										 "10"		=> "October ",
										 "11"		=> "November",
										 "12"		=> "December",
									 );
?>
	<!--In lich-->
	<div class="canlenda_cucre">
		<div class="title"><?=translate("Tìm theo ngày")?></div>
		<div class="date"><?="Tháng " . $month . "&nbsp; năm " . $year?></div>
		<table cellpadding="4" cellspacing="0" align="center">
			<tr>
			<?
			//ghi ra thứ
			for ($i=0;$i<=6;$i++){
			?>
				<td class="canlenda_cucre_header"><?=$arrDay[$i]?></td>
			<?
			}
			?>
			</tr>
			
			<?
			//Ngày đầu tiên của tháng
			$first_day = date("w",mktime(1,0,0,$month,1,$year));
			$num_cell = ($first_day >= 5) ? 42 : 35; 
			
			//write lich
			for ($i=0;$i<$num_cell;$i++){
				//ghi ra <tr>
				if ($i==0) echo "<tr class='canlenda_cucre_tr'>";
				
				//tao the dong
				if ($i!=0 && $i % 7==0){ 
					if ($i!=$num_cell-1)	echo "</tr>\n<tr class='canlenda_cucre_tr'>";
					else	echo "</tr>";
				}
				
				if ($i-$first_day >= 0){
					if (checkdate($month,$i-$first_day+1,$year)){
						$date = $i-$first_day+1;
						
						//Neu ton tai pha gia chua het han thi in link
						if($date <= $end_date_has_cucre && $date >= date("d")){
							echo '<td class="canlenda_cucre_actvie"><a href="' .generate_calendar_cucre_url($date, $month, $year) . '">' . $date . '</a></td>';
						}
						else{
							echo '<td>' . $date . '</td>';
						}

						
					}//if (checkdate($month,$i-$first_day+1,$year))
					else{
						//nhung o khong co ngay
						echo '<td>&nbsp;</td>';
					}
				}// END if ($i-$first_day >= 0){
				else{
					echo '<td>&nbsp;</td>';
				}//else{
			}
			?>
		</table>
	</div>
<?
}
?>
