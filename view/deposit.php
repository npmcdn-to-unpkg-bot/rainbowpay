<?php
require_once 'conn.php';

//variables passed from Form
$name = $_POST['name'];
$card = $_POST['card'];
$amount= $_POST['amount'];
$agent = $_POST['agent'];
$location = $_POST['location'];

/*code for card and Name and Agent check*/

/**card check **/
$card_check = mysqli_query($db_conn,"SELECT * FROM card_tb WHERE card_no = '".$card."'");
$card_row = $card_check);
// card exists

/***name check ***/
$buyer_check = mysqli_query($db_conn,"SELECT * FROM buyer_tb WHERE username = '".$name."' && card_no = '".$card."' ");
$buyer_row = $buyer_check);
// user exists

/***agent check****/
$agent_check = mysqli_query($db_conn,"SELECT * FROM agent_tb WHERE id = '".$agent."'");
$agent_row = $agent_check);
//user exists

if($card_row != 0 && $buyer_row != 0 && $agent_row != 0  ){ // means all exist
   //get old balance
    $old_buyer_balance = $buyer_row['balance'];
    
    //get old balance of agent
    $old_agent_balance = $agent_row['balance'];
    
    //reduce amount from agent with new deduction
    $new_agent_balance = $old_agent_balance - $amount ;
    mysqli_query($db_conn,"UPDATE  agent_tb SET balance = '".$new_agent_balance."' WHERE id = '".$agent."'");
    
    //add new new amount to buyer
    $new_buyer_balance = $old_buyer_balance + $amount ;
     mysqli_query($db_conn,"UPDATE  buyer_tb SET balance = '".$new_buyer_balance."' WHERE card_no = '".$card."' && username = '".$name."' ");
    
    //record transactions for buyer with new balance
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'buyer_deposit', '".$amount."', '".$agent."', '".$card."', '0000','".$charge."','".$location."','".$new_buyer_balance."')");
    
    //record transactions for agent with new balance
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'agent_withdrawl', '".$amount."', '".$agent."', '".$card."', '0000','".$charge."','".$location."','".$new_agent_balance."')");
    
    //update the bank
    $sql_bank = mysqli_query($db_conn,"SELECT * FROM buyer_tb WHERE  username = 'bank'");
    $row_bank = $sql_bank);
    $old_bank_balance = $row_bank['balance'];
    $new_bank_balance = $old_bank_balance + $amount ;
    mysqli_query($db_conn,"UPDATE  buyer_tb SET balance = '".$new_bank_balance."' WHERE username = 'bank' ");
    
    ////record transactions for bank with new balance
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'bank_count', '".$amount."', '".$agent."', '".$card."', '0000','".$charge."','".$location."','".$new_bank_balance."')");
    //the end
    
    //provide server response
   // echo json_encode('deposited');
    
    //redirect to success page
    header("Location: success.html");
die();
 
}else{
    //record failed transaction
    mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'failed_deposit', '".$amount."', '".$agent."', '".$card."', '0000','".$charge."','".$location."','000')");
    header("Location: failure.html");
}

?>