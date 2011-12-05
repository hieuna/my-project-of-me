<?php
defined('PG_PAGE') or die();

class PGDatetime {

	// INITIALIZE VARIABLES
	var $is_error;			// DETERMINES WHETHER THERE IS AN ERROR OR NOT

	function PGDatetime() {
	}

	function timestampToDateTime($timestamp=''){
		if (!$timestamp) $timestamp=time();
		return date("Y-m-d H:i:s", $timestamp);
	}
	
	function datetimeToTimestamp($datetime=''){
		if (!$datetime || $datetime=='0000-00-00 00:00:00') return time();
		
		list($date, $time) = explode(' ', $datetime);
		list($year, $month, $day) = explode('-', $date);
		list($hour, $minute, $second) = explode(':', $time);		
		return mktime($hour, $minute, $second, $month, $day, $year);
	}
	
	function datetimeDisplay($datetime, $onlyDate=false){
		if ($onlyDate) return date('d/m/Y', PGDatetime::datetimeToTimestamp($datetime)); 
		return date('H:i:s d/m/Y', PGDatetime::datetimeToTimestamp($datetime));
	}
	
	function convertDate($string, $format = 'mm/dd/yyyy'){
		$d = explode('/', $string);
		if ($format == "dd/mm/yyyy") {
			return date('Y-m-d', mktime(0, 0, 0, $d[1], $d[0], $d[2]));
		}
		else if ($format == "yyyy/mm/dd") {
			return date('Y-m-d', mktime(0, 0, 0, $d[1], $d[2], $d[0]));
		}
		else if ($format == "dd-mm-yyyy") {
			$d = explode('-', $string);
			return date('Y-m-d', mktime(0, 0, 0, $d[1], $d[0], $d[2]));
		}
		else if ($format == "mm-dd-yyyy") {
			$d = explode('-', $string);
			return date('Y-m-d', mktime(0, 0, 0, $d[0], $d[1], $d[2]));
		}
		return date('Y-m-d', mktime(0, 0, 0, $d[0], $d[1], $d[2]));
	}
}
?>