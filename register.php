<?php

// Connection details
 require_once 'conn.php';

// // Collect user input from a form
// $fullname = $_POST['fullname'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $tscNo = $_POST['tscNo'];

// // Hash the password for security
// $password = password_hash($password, PASSWORD_DEFAULT);

// //sql query
// $sql= "INSERT INTO users (fullname, email, password, tscNo) VALUES (?, ?, ?, ?)";
// // Prepare the SQL statement
// $stmt = mysqli_prepare($conn, $sql);

// // Bind parameters to the statement
// mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $password, $tscNo);

// // Execute the statement
// if (mysqli_stmt_execute($stmt)) {
//     echo "User registered successfully";
// } else {
//     echo "Error: " . mysqli_error($conn);
// }

// // Close the statement and database connection
// mysqli_stmt_close($stmt);

    
// mysqli_close($conn); 


// Collect user input from a form
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$tscNo = mysqli_real_escape_string($conn, $_POST['tscNo']);

// Hash the password for security
$password = password_hash($password, PASSWORD_DEFAULT);

// Create the SQL query
$sql = "INSERT INTO users (fullname, email, password, tscNo)
        VALUES ('$fullname', '$email', '$password', '$tscNo')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    echo "User registered successfully";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

?>