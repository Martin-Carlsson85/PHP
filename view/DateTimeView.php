<?php

class DateTimeView {


	public function show() {
		date_default_timezone_set("Europe/Stockholm");
		
		$day= date("l");
		$dateSuffix = date("S");
		$month = date("F");
		$year = date("Y");
		$time = date("H:i:s");
		$timeString = "$day, the $dateSuffix of $month $year, The time is $time";

		return '<p>' . $timeString . '</p>';
	}
}