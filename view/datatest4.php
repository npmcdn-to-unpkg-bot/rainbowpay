<?php 
require_once 'conn.php';
//header('Allow-Control-Allow-Origin:*');//allowing
header('Access-Control-Allow-Origin: *');
//external resource access


//$sql_data  = mysql_query("select * from transact_tb where type = 'purchase' AND card_no = '2016' limit 200");
//$sql_data  = mysql_query("select * from purchase_tb  limit 100,300");
//pending_tb
$sql_data  = mysql_query("select * from pending_tb ");

$numrows = mysql_num_rows($sql_data);

//echo  $numrows;
//$arr =  array('Type', 'Sales');
echo '[';
echo json_encode($arr).",";
$counter = 0;
 while ($row_pending = mysql_fetch_assoc($sql_data) AND $counter <300)
{
        echo   json_encode(array(substr($row_pending['time_stamp'], 0, -9),(int)$row_pending['amount'])).",";
     $counter++;
  
     }
$arrx =  array('2016-05-12',0);
echo json_encode($arrx);

echo ']';
//echo $counter;
/*
array_merge
$arr =array( array(
    'Year', 'Sales', 'Expenses'
), array(
    '2013', '1000', '460'
), array(
    '2012', '1170', '460'
));



echo json_encode($arr);
*/

?>