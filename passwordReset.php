<?php
function passwordReset($email){

    //require connection to the db and trim the value of the email
    require 'conn.php';
    $email = trim($email);

    //check email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return "Email is not valid";
     }

    //  query the database
     $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     $data = $result->fetch_assoc();

     if($data == NULL){
        return "Email doesn't exist in the database";
     }

     //If the email exists, create a random password which will be seven characters
     $str = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz";
     $password_length = 7;
     $new_pass = substr(str_shuffle($str), 0, $password_length);

     //hash the new password, so we can update the old password in the database.
     $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);

     $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE email = ?");
     $stmt->bind_param("ss", $hashed_password, $email);
     $stmt->execute();
     if($stmt->affected_rows != 1){
        return "There was a connection error, please try again."; 
     }

     // set up the mail's structure.
     $to = $email; 
     $subject = "Password recovery"; 
     $body = "You can log in with your new password". "\r\n";
     $body .= $new_pass; 

     //mail headers
     $headers = "MIME-Version: 1.0" . "\r\n";
     $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
     $headers .= "From: Admin \r\n";

     $send = mail($to, $subject, $body, $headers); 

     //if email is sent succefully
     if(!$send){ 
        return "Email not send. Please try again";
     }else{
        return "success";
     }
}

?>