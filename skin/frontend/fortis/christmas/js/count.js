// JavaScript Document
//month = '0', day = '+1', dow = 0, hour = 0
var month1 = '0'; // 1 through 12 or '*' within the next month, '0' for the current month //please set the month 12 to enable the counter upto next year 31st december.
var day1 = '+7';   // day of month or + day offset // please set the day 31 to enable the counter upto next year 31st december.
var dow1 = 0;     // day of week sun=1 sat=7 or 0 for whatever day it falls on
var hour1 = 0;    // 0 through 23 for the hour of the day
var min1 = 0;    // 0 through 59 for minutes after the hour
var tz1 = -8;     // offset in hours from UTC to your timezone  11 is set to australian time, please set the timezone offset accoring to your local time.
var lab1 = 'cd';  // id of the entry on the page where the counter is to be inserted

function start1() {
	displayCountdown1(setCountdown1(month1,day1,hour1,min1,tz1),lab1);
	}
loaded1(lab1,start1);

// Countdown Javascript
// copyright 20th April 2005, 1st November 2009 by Stephen Chapman
// permission to use this Javascript on your web page is granted
// provided that all of the code in this script (including these
// comments) is used without any alteration
// you may change the start function if required
var pageLoaded1 = 0; 
window.onload = function() {pageLoaded1 = 1;}
function loaded1(i1,f1) 
{
	if (document.getElementById && document.getElementById(i1) != null) f1();
	else if (!pageLoaded1) setTimeout('loaded1(\''+i1+'\','+f1+')',100);
}
function setCountdown1(month1,day1,hour1,min1,tz1) 
{
	var m1 = month1; 
	if (month1=='*') m1 = 0;  
	var c1 = setC1(m1,day1,hour1,tz1); 
	if (month1 == '*' && c1 < 0)  c1 = setC1('*',day1,hour1,tz1); 
	return c1;
	} 
	function setC1(month1,day1,hour1,tz1) 
	{
		var toDate1 = new Date();
		if (day1.substr(0,1) == '+') 
		{
			var day2 = parseInt(day1.substr(1));
			toDate1.setDate(toDate1.getDate()+day2);
			}
			else{
				toDate1.setDate(day1);
				}
				if (month1 == '*')toDate1.setMonth(toDate1.getMonth() + 1);
				else if (month1 > 0) 
				{ 
				if (month1 <= toDate1.getMonth())toDate1.setFullYear(toDate1.getFullYear() + 1);
				toDate1.setMonth(month1-1);
				}
if (dow1 >0) toDate1.setDate(toDate1.getDate()+(dow1-1-toDate1.getDay())%7);
toDate1.setHours(hour1);
toDate1.setMinutes(min1-(tz1*60));
toDate1.setSeconds(0);
var fromDate1 = new Date();

fromDate1.setMinutes(fromDate1.getMinutes() + fromDate1.getTimezoneOffset());
var diffDate1 = new Date(0);
diffDate1.setMilliseconds(toDate1 - fromDate1);
return Math.floor(diffDate1.valueOf()/1000);
}
function displayCountdown1(countdn1,cd) 
{
	if (countdn1 < 0) document.getElementById(cd).innerHTML = ""; 
	else {
		var secs1 = countdn1 % 60;
		if (secs1 < 10) secs1 = '0'+secs1;var countdn2 = (countdn1 - secs1) / 60;var mins1 = countdn2 % 60; if (mins1 < 10) mins1 = '0'+mins1;countdn2 = (countdn2 - mins1) / 60;
		var hours1 = countdn2 % 24;
		var days1 = (countdn2 - hours1) / 24;
		if(hours1<10)
		 {
			hours1='0'+hours1; 
		 }
		 else
		 {
			 hours1=hours1;
		 }
		document.getElementById(cd).innerHTML = hours1+' : '+mins1+' : '+secs1;
		setTimeout('displayCountdown1('+(countdn1-1)+',\''+cd+'\');',999);
		}
	}