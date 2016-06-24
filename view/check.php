<?php
require_once 'conn.php';


$status = $_GET["status"];
$id = $_GET["id"];
$invoice = $_GET["invoice"];



if($status == "approved"){
    //update pending status
   mysql_query("UPDATE  pending_tb SET status = 'Approved' WHERE id = '".$id."' ");
   
    $sql_pending = mysql_query("SELECT * FROM pending_tb WHERE id = '".$id."' ");
    
    $row_pending = mysql_fetch_array($sql_pending);
    
    //insert as payment
        mysql_query("INSERT INTO payments_tb ( seller, amount, time_stamp, card_no, manager, pending_id, invoice_no, charge, purchase_id) VALUES ( '".$row_pending['seller']."', '".$row_pending['amount']."', CURRENT_TIMESTAMP, '".$row_pending['card_no_seller']."', 'admin', '".$row_pending['id']."', '".$invoice."', '00', '".$row_pending['purchase_id']."')");
    
    //pay seller
    
         $sql_balance = mysql_query("SELECT balance FROM seller_tb WHERE username = '".$row_pending['seller']."'");
         $row_balance = mysql_fetch_array($sql_balance);
        
    
         $new_balance = $row_balance['balance'] + $row_pending['amount'];
        
    mysql_query("UPDATE  seller_tb SET balance = '".$new_balance."' WHERE username = '".$row_pending['seller']."' ");  
    
    
    echo "Success";
    
}else if($status == "decline"){
   
     mysql_query("UPDATE  pending_tb SET status = 'Declined' WHERE id = '".$id."' ");
    
  echo "failed";
}else {
    echo "failed no data ";
}

//header("Location:./approve.php");
?>