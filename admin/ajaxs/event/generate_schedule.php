<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
$stime = isset($_POST['stime']) ? trim($_POST['stime']) : '';
$etime = isset($_POST['etime']) ? trim($_POST['etime']) : '';

/*
 $date1, $date2 : string date
 return int days between $date1 and $date2
*/
 function countDays($date1, $date2){
 	$startTimeStamp = strtotime($date1);
 	$endTimeStamp = strtotime($date2);

 	$timeDiff = abs($endTimeStamp - $startTimeStamp);

	$numberDays = $timeDiff/86400;  // 86400 seconds in one day

	// and you might want to convert to integer
	$numberDays = intval($numberDays);
	return $numberDays;
}

if($stime !=='' && $etime !==''){
	$begin = new DateTime($stime);
	$end = new DateTime($etime);
	$numDay = countDays($stime, $etime);

	$interval = DateInterval::createFromDateString('1 day');
	$period = new DatePeriod($begin, $interval, $end);

	$str='<table class="table table-bordered table-schedule">';
	$str.='<tbody>';
	$j=0;

	for($i = $begin; $i <= $end; $i->modify('+1 day')){
	    $day = $i->format("Y-m-d");
	    $day1 = $i->format("Ymd");
	    if($j == 0){
			$str.='<tr class="item-tr">';
		}
		$str.='<td class="idate" data-date="'.$day1.'">
		<div class="iheader">'.$day.'<span class="btn_add_event_item" onclick="add_event_item(this)" data-date="'.$day1.'"><i class="fa fa-plus-circle" aria-hidden="true"></i></span></div>
		<div class="icontent">
		<div class="isang"></div>
		<div class="ichieu"></div>
		</div>
		</td>';
		if($j == 4){
			$str.='</tr>';
			$j=0;
		}else{
			$j++;
		}
	}

	$str.='</tbody>';
	$str.='<table>';

	echo $str;
}
?>