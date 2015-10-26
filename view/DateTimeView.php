<?php

namespace view;
class DateTimeView {

    /**
     * Creates a string containing date, time and stuff for render on screen later
     * @return string
     */
	public function show() {
		date_default_timezone_set("Europe/Stockholm");
		
		$day= date("l");
		$dayOfMonth = date("j");
		$dateSuffix = date("S");
		$month = date("F");
		$year = date("Y");
		$time = date("H:i:s");
		$timeString = "$day, the $dayOfMonth$dateSuffix of $month $year, The time is $time";

		return '<h5>' . $timeString . '</h5>';
	}
}