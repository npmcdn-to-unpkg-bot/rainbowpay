<?php
require_once 'conn.php'; //connection link
header('Allow-Control-Allow-Origin:*');//allowing external resource access


//varaibles passed
   $card =  $_POST["card"]; /***/
   $amount = $_POST["amount"];  /***/
   $seller = $_POST["seller"];  /***/
   $product =$_POST["product"];
   $quantity = $_POST["quantity"];
   $name = $_POST["name"];  /***/
   $pin = $_POST["pin"];  /***/
//check card and user and seller

/**card check **/
$card_check = mysqli_query($db_conn,"SELECT * FROM card_tb WHERE card_no = '".$card."'");
$card_row = $card_check);
// card exists

/***name check ***/
$buyer_check = mysqli_query($db_conn,"SELECT * FROM buyer_tb WHERE username = '".$name."' && card_no = '".$card."' && pin = '".$pin."' ");
$buyer_row = $buyer_check);
// user exists

/***seller check****/
$seller_check = mysqli_query($db_conn,"SELECT * FROM seller_tb WHERE id = '".$seller."'");
$seller_row = $seller_check);
//user exists

if( $card_row != 0  &&  $buyer_row != 0  && $seller_row != 0   ){ // means all exist

    //compute charge
    $charge_rate = 0.01;
    $charge = $amount * $charge_rate;
    
    //seller cash
    $seller_cash = $amount - $charge;
    
    //create token for purchase
    $num = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','y','z');

for($i=0;$i<26;$i++){
   // echo $num[rand(0,$i)] ;
    $token .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the token
}
    //insert new purchase
     mysqli_query($db_conn,"INSERT INTO  purchase_tb  ( item ,  amount ,  seller ,  buyer ,  quantity ,  card_no ,   token ) VALUES ( '".$product."', '".$seller_cash."', '".$seller."', '".$name."', '".$quantity."', '".$card."', '".$token."')");
    
    //insert new pending account
     mysqli_query($db_conn,"INSERT INTO pending_tb  (  seller ,  amount , card_no_seller ,  product ,  status,purchase_token ) VALUES (  '".$seller."', '".$seller_cash."', '".$seller_row['card_no']."', '".$product."', 'new','".$token."')");
    
    //update buyers account    
    $old_buyer_balance = $buyer_row['balance'];//get old balance
    $new_buyer_balance = $old_buyer_balance - $amount ;
     mysqli_query($db_conn,"UPDATE  buyer_tb SET balance = '".$new_buyer_balance."' WHERE card_no = '".$card."' && username = '".$name."' ");
    
     //insert new transaction
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'purchase', '".$amount."', '0000', '".$card."', '".$token."','".$charge."','".$seller."','".$new_buyer_balance."')");
    echo json_encode($token.'success');
    
}else{
    //do otherwise
    //create token for failed_purchase
    $num = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','y','z');

for($i=0;$i<26;$i++){
   // echo $num[rand(0,$i)] ;
    $token .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the token
}
     //insert failed transaction
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'failed_purchase', '".$amount."', '0000', '".$card."', '".$token."','0000','".$seller."','".$buyer_row['balance']."')");
    
 echo json_encode($token.'failed');

}

?>