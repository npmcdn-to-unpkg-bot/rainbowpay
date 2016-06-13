<?php
require_once 'conn.php';

//recieve_name
$name =  $_POST["uname"];


//echo $card;
someLine:

$numx;
$num = array('0','1','2','3','4','5','6','7','8','9');
//create Card
for($i=0;$i<11;$i++){
   // echo $num[rand(0,$i)] ;
    $card .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the card
}
    
//create PIN
$numz;
for($x=0;$x<10;$x++){
   $numz .= $num[rand(rand(0,$x),$x)] ;
//concatinate the pin
}

//dont create pin , becuase already entered by user
 

$agent = 0000;
// echo $numx ;

$oldcard = mysqli_query($db_conn,"Select * FROM card_tb where card_no = '".$card."' AND serial = '".$numz."' AND pin = '".$_POST["pin"]."' ");

$numrows = mysqli_num_rows($oldcard);


if($numrows == 0){
    // echo $numx ;
    mysqli_query($db_conn,"INSERT INTO card_tb  ( card_no ,  pin ,  date_of_make ,  serial ,  assigned ,  agent_id ) VALUES ( '".$card."', '".$_POST["pin"]."', CURRENT_TIMESTAMP, '".$numz."', '".$name."', '".$agent."')");
    
     mysqli_query($db_conn,"INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'card_make', '000', '".$agent."', '".$card."', '0','0','".$_POST["location"]."')");
    
}else{
    
    goto someLine;
    
}

?>