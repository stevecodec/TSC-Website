<?php
function logoutUser(){
   session_destroy();
   header("location: login.php");
   exit();
}

?>