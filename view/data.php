<?php
require_once 'conn.php';

/*
$name  = $_POST['name'];
$card = $_POST['card'];
*/

 $sql_pending = mysql_query("SELECT * FROM transact_tb ");
    
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
$data = array();
    $data['cols'] = array(
                    array('id' => '','label' => 'Sig','Pattern' => '', 'type' => 'string'),
                    array('id' => '','label' => 'Time','Pattern' => '', 'type' => 'number')
                    );
  while ($row_pending = mysql_fetch_assoc($sql_pending) and $v < $numrows )
{

     //$a[$v] = $row_pending['id'];
      array_push($a,$row_pending['amount']);
    
      $data['rows'] = array(array("c" =>
                    array(array('v' => $row_pending['amount'],'f' => null)
                    )));
      // $pon =  array("c" => array(array('v' => 'Mushrooms','f' => null),array('v' => '3','f' => null)));
      //array_map(null, $letters, $numbers)
      
  $v++;    
}






echo json_encode($data);

echo "<table>";
echo "</div>";
/* $letters = array('a','b','c','d','e');
 $numbers = array(1,2,3,4,5);
 print(json_encode(array_map(null, $letters, $numbers))); 
 */


?>