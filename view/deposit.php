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
    $namexy  = geoip_country_name_by_addr($gi,$ip);
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


//variables passed from Form
$name = $_POST['name'];
$card = $_POST['card'];
$amount= $_POST['amount'];
$agent = $_POST['agent'];
$location = $_POST['location'];

/*code for card and Name and Agent check*/
//create token for purchase
    $num = array('0','1','2','j','k','l','m','n','o','6','7','8','9','p','q','r','s','t','u','3','4','5','a','b','c','d','e','f','g','h','i','v','w','y','z');
for($i=0;$i<26;$i++){ // Token
   // echo $num[rand(0,$i)] ;
    $token .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the token
}

/**card check **/
$card_check = mysql_query("SELECT * FROM card_tb WHERE card_no = '".$card."'");
$card_row = mysql_fetch_assoc($card_check);
// card exists

/***name check ***/
$buyer_check = mysql_query("SELECT * FROM buyer_tb WHERE username = '".$name."' && card_no = '".$card."' ");
$buyer_row = mysql_fetch_assoc($buyer_check);
// user exists

/***agent check****/
$agent_check = mysql_query("SELECT * FROM agent_tb WHERE id = '".$agent."'");
$agent_row = mysql_fetch_assoc($agent_check);
//user exists

if($card_row != 0 && $buyer_row != 0 && $agent_row != 0  ){ // means all exist
    $token .='deposit'; 
   //get old balance
    $old_buyer_balance = $buyer_row['balance'];
    
    //get old balance of agent
    $old_agent_balance = $agent_row['balance'];
    
    //reduce amount from agent with new deduction
    $new_agent_balance = $old_agent_balance - $amount ;
    mysql_query("UPDATE  agent_tb SET balance = '".$new_agent_balance."' WHERE id = '".$agent."'");
    
    //add new new amount to buyer
    $new_buyer_balance = $old_buyer_balance + $amount ;
     mysql_query("UPDATE  buyer_tb SET balance = '".$new_buyer_balance."' WHERE card_no = '".$card."' && username = '".$name."' ");
    
    //record transactions for buyer with new balance
     mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'buyer_deposit', '".$amount."', '".$agent."', '".$card."', '".$token."','".$charge."','".$location."','".$new_buyer_balance."')");
    
    //record transactions for agent with new balance
     mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'agent_withdrawl', '".$amount."', '".$agent."', '".$card."', '".$token."','".$charge."','".$location."','".$new_agent_balance."')");
    
    //update the bank
    $sql_bank = mysql_query("SELECT * FROM buyer_tb WHERE  username = 'bank'");
    $row_bank = mysql_fetch_assoc($sql_bank);
    $old_bank_balance = $row_bank['balance'];
    $new_bank_balance = $old_bank_balance + $amount ;
    mysql_query("UPDATE  buyer_tb SET balance = '".$new_bank_balance."' WHERE username = 'bank' ");
    
    ////record transactions for bank with new balance
     mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'bank_count', '".$amount."', '".$agent."', '".$card."', '".$token."','".$charge."','".$location."','".$new_bank_balance."')");
    //the end
    
    //provide server response
   // echo json_encode('deposited');
    
    //redirect to success page
    header("Location: success.html");
die();
 
}else{
    $token .='fail-deposit'; 
    //record failed transaction
    mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'failed_deposit', '".$amount."', '".$agent."', '".$card."', '".$token."','".$charge."','".$location."','000')");
    header("Location: failure.html");
}

?>