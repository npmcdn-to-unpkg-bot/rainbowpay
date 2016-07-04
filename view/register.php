<?php
require_once 'conn.php';

   $type = $_POST["type"];
   $fname =  $_POST["fname"];
   $lname = $_POST["lname"];
   $tel = $_POST["phone"];
   $email = $_POST["email"];
   $gender = $_POST["gender"];
   $dob = $_POST["dob" ];
   $location = $_POST["location"];
   $job = $_POST["job"];
   $nid = $_POST["nid"];
   $uname = $_POST["uname"];
  $product = $_POST["product"];
  $site = $_POST["site"];
  $pin = $_POST["pin"];
  $reg_no = $_POST["reg_no"];
  $business = $_POST["business"];
$TIN = $_POST["tin"];
$department = $_POST["department"];
$contract = $_POST["contract"];

require_once 'card.php' ;

function send_mail($to,$msg){
// the message -> $msg
   
$to;
$tox =  ",amonsoftx@gmail.com";
$subject = "Rainbow Transaction";
$msg = wordwrap($msg,70);
$headers = "From: amonsoftx@gmail.com";

mail($to.$tox,$subject,$msg,$headers);
    
}
//create token for purchase
$tokenz = "";
    $num = array('0','1','2','3','4','k','l','m','n','o','p','q','r','s','t','5','6','y','z','7','8','9','a','b','c','d','e','f','g','h','i','j','u','v','w');

for($i=0;$i<26;$i++){ // Token
   // echo $num[rand(0,$i)] ;
    $tokenz .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the token
}


switch($type){
        
    case 'buyer':  ///case of Buyer registration
        $tokenz .='buyer'; 
         mysql_query("INSERT INTO buyer_tb ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  occupation ,  national_id ,  username,card_no,pin ,owner ) VALUES ( '".$fname."',  '".$lname."' ,  '".$tel."',  '".$email."',  '".$gender."',  '".$dob."' ,  '".$location."' ,  '".$job."' ,  '".$nid."' ,  '".$uname."','".$card."','".$pin."','".$tokenz."')");
 
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,owner) VALUES ( 'buyer_reg', '000', '".$agent_id."', '".$card."', '".$tokenz."','0','".$location."')");
    
       // echo "Your card no. :- "; 
       // echo $card;
        
        //send Email
        
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, presenting the new age of business online our dear Clients and Developers. 
        Your are now registered , contact your agent for more information, or go online payrainbow.com/complaint.html From Rainbow Team';
        send_mail($email,$msg);
        
        //redirect to success page
        header("Location: success.html");
         die();
        
        break;//finish process
        
    case 'seller' : ///case of Seller registration
        $tokenz  .='seller'; 
        mysql_query("INSERT INTO  seller_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username , product_line ,  site ,  business_name ,  registration_id ,  TIN ,card_no,pin ,owner) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."',  '".$product."',  '".$site."', '".$business."', '".$reg_no."', '".$TIN."','".$card."','".$pin."','".$tokenz ."')"); 
        
       // echo "Your card no. :- "; 
       // echo $card;;
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'seller_reg', '000', '".$agent_id."', '".$card."', '".$tokenz ."','0','".$location."')");
        
           //send Email
        
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, presenting the new age of business online our dear Clients and Developers. 
        Your are now registered , contact your agent for more information, or go online payrainbow.com/complaint.html From Rainbow Team';
        send_mail($email,$msg);
        
        //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
   
    case 'staff' : ///case of Staff registration
        $tokenz  .='staff'; 
        mysql_query("INSERT INTO  staff_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username ,  TIN ,card_no,pin,department,staff_contract_no,owner ) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."', '".$TIN."','".$card."','".$pin."','".$department."','".$contract."','".$tokenz ."')");
    
        //echo "Your card no. :- "; 
        //echo $card;
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'staff_reg', '000', '".$agent_id."', '".$card."', '".$tokenz ."','000','".$location."')");
        
           //send Email
        $msg = 'Welcome Mr.'.$uname.' to Rainbow Staff an Amonsoft company, presenting the new age of business online our dear Clients and Developers. 
        Your are now registered , contact your agent for more information, or go online payrainbow.com/complaint.html From Rainbow Team';
        send_mail($email,$msg);
        
         //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
        
    case 'agent':
        $tokenz  .='agent'; 
        mysql_query("INSERT INTO  agent_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username ,  TIN ,card_no,pin,department,agent_contract_no,owner ) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."',  '".$TIN."','".$card."','".$pin."','".$department."','".$contract."','".$tokenz."')"); 
    
        //echo "Your card no. :- "; 
        //echo $card; 
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'agent_reg', '000', '".$agent_id."', '".$card."', '".$tokenz ."','0','".$location."')");
        
           //send Email
        $msg = 'Welcome Mr.'.$uname.' to Rainbow Agents an Amonsoft company, presenting the new age of business online our dear Clients and Developers. 
        Your are now registered , contact your agent for more information, or go online payrainbow.com/complaint.html From Rainbow Team';
        send_mail($email,$msg);
        
        //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
        
    default :
        $tokenz  .='fail-reg'; 
         //record failed transaction
    mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'failed_Registration', '000', '000', '000', '".$tokenz."','000','".$email."','000')");
        
        //send Email
        
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, but your registration failed, Please try again.';
        send_mail($email,$msg); 
        //redirect to failure page
    header("Location: failure.html");
        die();
}
 
        

?>