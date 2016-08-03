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
    $namexxc  = geoip_country_name_by_addr($gi,$ip);
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



$name  = $_POST['name'];
$card = $_POST['card'];


 $sql_pending = mysql_query("SELECT * FROM transact_tb WHERE card_no = '".$card."'");
    
$numrows = mysql_num_rows($sql_pending);


echo " <div class='payment' >";
   echo "<table style='
    border: groove;
    border-width: 4px;'>
<tr>
<td>ID</td>
<td>Type</td>
<td>Amount</td>
<td>Date</td>
<td>Agent</td>
<td>MM_CODE</td>
<td>Charge</td>
<td>balance</td>
<td>location</td>


</tr>


";

$a = array();
$v =0;
  while ($row_pending = mysql_fetch_assoc($sql_pending) and $v < $numrows )
{

     //$a[$v] = $row_pending['id'];
      array_push($a,$row_pending['id']);
       
      //table for showing data
      
      echo "<tr>";
        echo "<td style='border: groove 1px ;'>";
      echo  $row_pending['id'];   ;
      echo " ";
  echo "</td>";
      
         echo "<td style='border: groove 1px ;'>";
      echo $row_pending['type'];
      echo " ";
  echo "</td>";
      
      echo "<td style='border: groove 1px ;'>";
     echo $row_pending['amount'];
      echo " ";
      
      echo "<td style='border: groove 1px ;'>";
      echo $row_pending['time_stamp'];
      echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
      echo $row_pending['agent_id'];
      echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
     echo $row_pending['mm_code'];
     echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
      echo $row_pending['charge'];
       echo " ";
       echo "</td>";
      
      echo "<td style='border: groove 1px ;'>";
      echo $row_pending['balance'];
       echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
      echo $row_pending['location'];
       echo " ";
       echo "</td>";
      
         echo "</tr>";
  $v++;    
}
echo "<table>";
echo "</div>";


?>