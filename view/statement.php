<?php
require_once 'conn.php';


//$name  = $_POST['name'];
$card = $_POST['card'];


 $sql_pending = mysqli_query($db_conn,"SELECT * FROM transact_tb WHERE card_no = '".$card."'");
    
$numrows = mysqli_num_rows($sql_pending);


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
  while ($row_pending = mysqli_fetch_assoc($sql_pending) and $v < $numrows )
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