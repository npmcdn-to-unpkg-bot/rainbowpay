<?php 

include_once('geoip.inc');
echo var_export(unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR'])));
//set an IPv6 address for testing
//$ip='2601:8:be00:cf20:ca60:ff:fe09:35b5';
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

echo $ip . "<br>" . $country."<br>";
echo $name . "<br>"  ;
echo $hostname . "<br>"  ;
echo $bigname  . "<br>"  ;

// Collect a specific users GEOIP info
$info = geoip_record_by_addr($gi,$ip);
echo $info;

// To get the info from one specific field
$countryx = $info['country_name'];
echo $countryx;

// To combine information from the array into a string
$info = implode("/", $info);
echo $info;

//http://api.ipinfodb.com/v3/ip-city/?key=<your_api_key>&ip=74.125.45.100
?>