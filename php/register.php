<?php

require_once 'conn.php';

if(isset($_POST['id']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password'])){


    $fullname=$email=$password="";

    //getting the user input
    $tscNo = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    if(empty($tscNo)){
        header ("Location: register.php? error = Tsc number is required!");
    }
    elseif(empty($email)){
        header("Location: register.php? error = Email cannot be empty!");
    }
    else{
        echo 'Good';
    }

    //check password length
    if(strlen(trim($_POST['password'])) < 8){
    echo 'password must have a minimum of 8 characters';
    }
    else{
        $password = trim($_POST['password']);

        if($password != $re_password){
            echo "The passwords don't match";
        }
        $pass = password_hash($password, PASSWORD_DEFAULT);
    }       

        //to prepare the sql statement
        $query = "INSERT INTO users(fullname, email, password, tscNo) VALUES(?,?,?,?)";
        $stmt = mysqli_prepare($conn, $query);

        //to bind the parameters
        mysqli_stmt_bind_param($stmt, 'ssss',$fullname, $email, $pass, $tscNo);

        //executing the statements
        if(mysqli_stmt_execute($stmt)){

            //redirect the user to the login page
            header("location: login.php");
        }
        else{
            echo 'Failed. Try Again!';
        } 
        
    //closing the statement and the connection
    mysqli_stmt_close($stmt);
    
    }
    
    mysqli_close($conn); 
?>