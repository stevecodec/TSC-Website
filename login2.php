<?php

require_once 'conn.php';

if(isset($_POST['tscNo']) && isset($_POST['password'])){

    $tscNo = mysqli_real_escape_string($conn, $_POST['tscNo']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    $err = "";

    $sql = "SELECT * from users where tscNo = '$tscNo' and password = '".password_hash($password, PASSWORD_DEFAULT)."' limit 1";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);

    if($rows==1){
        header("Location: index11.php");
    }
    else{
        echo "Username or password is incorrect";
    }

}
?>