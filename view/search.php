<!DOCTYPE html>
<html lang="en-us">
      <head>
    <meta charset="UTF-8">
    <title>Rainbow by Amonsoft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="stylesheets/github-light.css" media="screen">
  </head>
  <body>
    <section  class="page-header">
        <h2>Search by Token</h2>
        <a href="index.html" class="btn">HOME</a>

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
    $namecc  = geoip_country_name_by_addr($gi,$ip);
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


$sql_pending = mysql_query("SELECT * FROM pending_tb WHERE purchase_token = '".$_POST['search']."'");
    
$numrows = mysql_num_rows($sql_pending);


echo " <div class='payment' >";
   echo "<table style='
    
    border: groove;
    border-width: 2px;
    margin-left: 15%;
    '>
<tr>
<td>ID</td>
<td>Purchase ID</td>
<td>Seller</td>
<td>Amount</td>
<td>Time Stamp</td>
<td>Card_Seller</td>
<td>Product</td>
<td>Status</td>
<td>Invoice No.</td>

</tr>


";

$a = array();
$v =0;
  while ($row_pending = mysql_fetch_assoc($sql_pending) and $v < $numrows )
{
  //$a[$v] = $row_pending['id'];
      array_push($a,$row_pending['id']);
       
      
      
      echo "<tr >";
        echo "<td style='border: groove 1px ;' >";
      echo  $row_pending['id'];   ;
      echo " ";
  echo "</td>";
      
         echo "<td style='border: groove 1px ;'>";
      echo $row_pending['purchase_id'];
      echo " ";
  echo "</td>";
      
      echo "<td style='border: groove 1px ;'>";
     echo $row_pending['seller'];
      echo " ";
      
      echo "<td style='border: groove 1px;width: 8%;'>";
      echo $row_pending['amount'];
      echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px;width: 21%;'>";
      echo $row_pending['time_stamp'];
      echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
     echo $row_pending['card_no_seller'];
     echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
      echo $row_pending['product'];
       echo " ";
       echo "</td>";
      
       echo "<td style='border: groove 1px ;'>";
     echo $row_pending['status'];
     echo " ";
       echo "</td>";
       
      if( $row_pending['status'] == "new"){
       echo "<td style='border: groove 1px ;'>";
          $t =$row_pending["id"];
      echo "<button style='margin-top: 14px;' id='approve' name='$t' disabled class='btn'  >Pending</button>";
     /* echo " ";
      echo "<button id='declined' name='$t' disabled class='btn'>Decline</button>"; */
      }else{
          echo "<td style='border: groove 1px;'>";
      echo "<button id='Done' style='margin-top: 14px; background: #ff000094;' class='btn' >Finished</button>";
      }
         echo "</tr>";
  $v++;    
}
echo "<table>";
echo "</div>";

//print_r($a);

        ?></br></br>
        <a href="./approve.php" class="btn">Approve</a> 

         </section>
       
<script lang="javascript" type="application/javascript"> 
   
    
  
function approve(){
 var invoice_no = document.getElementById('invoice').value;
    var numberx =  document.getElementById('number').value;
    
//console.log("1");
  //  console.log(numberx);
    
    
     
     var xhttp =  new XMLHttpRequest();
        
      xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            window.alert(xhttp.responseText);
            window.location.reload();
            }
        }
    
      var site = "check.php?status=approved&id=";
      
      var sitex = site.concat(numberx);
    
    var sitexx = sitex.concat("&invoice=");
    
    var finalx = sitexx.concat(invoice_no);
      xhttp.open("GET",finalx,true); 
    
   // xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    
   xhttp.send();
        
    
   
        
};
    function decline(){
    //console.log("Declined");
         var invoice_no = document.getElementById('invoice').value;
    var numberx =  document.getElementById('number').value;
         
        var xhttp =  new XMLHttpRequest();
        
     xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && xhttp.status == 200){
            window.alert(xhttp.responseText);
                 window.location.reload();
            }
        }
      var site = "check.php?status=decline&id=";
      
      var sitex = site.concat(numberx);
    
    var sitexx = sitex.concat("&invoice=");
    
    var finalx = sitexx.concat(invoice_no);
      xhttp.open("GET",finalx,true);  

    xhttp.send();
   
};
    
        

</script>
       </body>
</html>



