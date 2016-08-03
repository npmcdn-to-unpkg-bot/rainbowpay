<?php
require_once 'conn.php';
include('ip2locationlite.class.php');
include_once('geoip.inc');

 
//Load the class
$ipLite = new ip2location_lite;
$ipLite->setKey('6613ce305190b2e294ceec9a5fd31b2f52164288826a1fedb1a2da95e0bb6606');
 
//Get errors and locations
$locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
$errors = $ipLite->getError();
 
//set an IPv6 address for testing

$ip=$_SERVER['REMOTE_ADDR'];
$hostname = gethostbyaddr($ip);
/*
test if $ip is v4 or v6 and assign appropriate .dat file in $gi
run appropriate function geoip_country_code_by_addr() vs geoip_country_code_by_addr_v6() 
//$record = geoip_record_by_name($hostname);  
*/
if((strpos($ip, ":") === false)) {
    //ipv4
    $gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);
    $country = geoip_country_code_by_addr($gi, $ip);
    $name  = geoip_country_name_by_addr($gi,$ip);
   $bigname = geoip_country_name_by_name($hostname);
//by_name($hostname);
}   
else {
    //ipv6
    $gi = geoip_open("GeoIPv6.dat",GEOIP_STANDARD);
    $country = geoip_country_code_by_addr_v6($gi, $ip);

}

$statuscode = $locations['statusCode'];
$ipAddress = $locations['ipAddress'];
$zipCode = $locations['zipCode'];
$countryCode  = $locations['countryCode'];
$countryName  = $locations['countryName'];
$regionName  = $locations['regionName'];
$cityName  = $locations['cityName'];
$latitude  = $locations['latitude'];
$longitude  = $locations['longitude'];
$timeZone  = $locations['timeZone'];

mysql_query("INSERT INTO place_db (  ip ,  country_code ,  country_name ,  region_name ,  city_name ,  latitude ,  longitude ,  timeZone ,  status_code ,  continent_code ,  host_name,zipCode )
 VALUES ( '".$ipAddress."', '".$countryCode."', '".$countryName."', '".$regionName."', '".$cityName."', '".$latitude."', '".$longitude."', '".$timeZone."', '".$statuscode."', '".$_SERVER['REQUEST_URI']."', '".$hostname."','".$zipCode."')");


//recieve_name
$name =  $_POST["uname"];


//echo $card;
someLine:

$numx;
$num = array('0','1','7','8','2','3','4','5','6','9');
//create Card
for($i=0;$i<11;$i++){
   // echo $num[rand(0,$i)] ;
    $card .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the card
}
    
//create PIN
$numz;
for($x=0;$x<10;$x++){
   $numz .= $num[rand(rand(0,$x),$x)] ;
//concatinate the pin
}

//dont create pin , becuase already entered by user
  $numx = array('b','c','d','0','y','z','1','2','3','4','5','6','7','8','9','a','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w');
//token
for($i=0;$i<26;$i++){
   // echo $num[rand(0,$i)] ;
    $token .= $numx[rand(rand(0,$i),$i)] ;
//concatinate  the token
}


$agent = 0000;
// echo $numx ;

$oldcard = mysql_query("Select * FROM card_tb where card_no = '".$card."' AND serial = '".$numz."' AND pin = '".$_POST["pin"]."' ");

$numrows = mysql_num_rows($oldcard);


if($numrows == 0){
    $token .= 'card';
    // echo $numx ;
    mysql_query("INSERT INTO card_tb  ( card_no ,  pin ,  date_of_make ,  serial ,  assigned ,  agent_id,owner ) VALUES ( '".$card."', '".$_POST["pin"]."', CURRENT_TIMESTAMP, '".$numz."', '".$name."', '".$agent."','".$token."')");
    
     mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'card_make', '000', '".$agent."', '".$card."', '".$token."','0','".$_POST["location"]."')");
    
}else{
    
    goto someLine;
    
}

?>