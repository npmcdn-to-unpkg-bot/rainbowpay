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
    $num = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','y','z');

for($i=0;$i<26;$i++){ // Token
   // echo $num[rand(0,$i)] ;
    $token .= $num[rand(rand(0,$i),$i)] ;
//concatinate  the token
}


switch($type){
        
    case 'buyer':  ///case of Buyer registration
        $token .='buyer'; 
         mysql_query("INSERT INTO buyer_tb ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  occupation ,  national_id ,  username,card_no,pin ,owner ) VALUES ( '".$fname."',  '".$lname."' ,  '".$tel."',  '".$email."',  '".$email."',  '".$dob."' ,  '".$location."' ,  '".$job."' ,  '".$nid."' ,  '".$uname."','".$card."','".$pin."','".$token."')");
 
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,owner) VALUES ( 'buyer_reg', '000', '".$agent_id."', '".$card."', '".$token."','0','".$location."')");
    
       // echo "Your card no. :- "; 
       // echo $card;
        
        //send Email
        /*
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, this will be how we shall be communicating . Welcome to the new age of business online our dear Client.';
        send_mail($email,$msg);
        */
        //redirect to success page
        header("Location: success.html");
         die();
        
        break;//finish process
        
    case 'seller' : ///case of Seller registration
        $token .='seller'; 
        mysql_query("INSERT INTO  seller_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username , product_line ,  site ,  business_name ,  registration_id ,  TIN ,card_no,pin ,owner) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."',  '".$product."',  '".$site."', '".$business."', '".$reg_no."', '".$TIN."','".$card."','".$pin."','".$token."')"); 
        
       // echo "Your card no. :- "; 
       // echo $card;;
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'seller_reg', '000', '".$agent_id."', '".$card."', '".$token."','0','".$location."')");
        
           //send Email
        /*
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, this will be how we shall be communicating . Welcome to the new age of business online our dear Client.';
        send_mail($email,$msg);
        */
        //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
   
    case 'staff' : ///case of Staff registration
        $token .='staff'; 
        mysql_query("INSERT INTO  staff_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username ,  TIN ,card_no,pin,department,staff_contract_no,owner ) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."', '".$TIN."','".$card."','".$pin."','".$department."','".$contract."','".$token."')");
    
        //echo "Your card no. :- "; 
        //echo $card;
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'staff_reg', '000', '".$agent_id."', '".$card."', '".$token."','000','".$location."')");
        
           //send Email
        /*
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, this will be how we shall be communicating . Welcome to the new age of business online our dear Client.';
        send_mail($email,$msg);
        */
        
         //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
        
    case 'agent':
        $token .='agent'; 
        mysql_query("INSERT INTO  agent_tb  ( first_name ,  last_name ,  mobile_no ,  email ,  gender ,  dob ,  location ,  national_id ,  username ,  TIN ,card_no,pin,department,agent_contract_no,owner ) VALUES ('".$fname."', '".$lname."', '".$phone."', '".$email."', '".$gender."', '".$dob."', '".$location."','".$nid."', '".$uname."',  '".$TIN."','".$card."','".$pin."','".$department."','".$contract."','".$token."')"); 
    
        //echo "Your card no. :- "; 
        //echo $card; 
    
        mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location) VALUES ( 'agent_reg', '000', '".$agent_id."', '".$card."', '".$token."','0','".$location."')");
        
           //send Email
        /*
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, this will be how we shall be communicating . Welcome to the new age of business online our dear Client.';
        send_mail($email,$msg);
        */
        
        //redirect to success page
         header("Location: success.html");
         die();
        
        break;//finish process
        
    default :
        $token .='fail-reg'; 
         //record failed transaction
    mysql_query("INSERT INTO transact_tb ( type, amount, agent_id, card_no, mm_code, charge, location,balance) VALUES ( 'failed_Registration', '000', '000', '000', '".$token."','000','".$email."','000')");
        
        //send Email
        /*
        $msg = 'Welcome Mr.'.$uname.' to Rainbow an Amonsoft company, but your registration failed, Please try again.';
        send_mail($email,$msg); */
        //redirect to failure page
    header("Location: failure.html");
        die();
}
 
        

?>