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
        <a href="index.html" class="btn">HOME</a>
<form action="">
<input id='number' placeholder='ID Number' class="btn"  />
<input id='invoice' placeholder='invoice' class="btn"  />  
<button type="button" onclick='approve()' class="btn">Approve</button>
    <button type="button" onclick='decline()' class="btn">Decline</button>
</form>
        <form action="search.php" method="post">
     <button type="submit" class="btn">Search</button>
</form>
        <?php
require_once 'conn.php';

$sql_pending = mysql_query("SELECT * FROM pending_tb");
    
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

?>

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



