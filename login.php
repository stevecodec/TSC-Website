<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get the TSC number and password from the form
  $tsc_number = $_POST['tscNo'];
  $password = $_POST['password'];

  // Connect to the database
  require_once 'conn.php';

  // TODO: query the database to check if the user exists and the password is correct
  $sql = "SELECT * FROM users WHERE tscNo = ? AND password=?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $tsc_number,$password);
  $stmt->execute();
  $result = $stmt->get_result();
  $data = $result->fetch_assoc();


  if ($data->num_rows > 0) {
    // User exists, check if password is correct
    if (password_verify($password, $data["password"]) == true ) {
      // Password is correct, set session variables and redirect to dashboard
      session_start();
      $_SESSION['user'] = $tsc_number;

      header("Location: index-2.html");
      exit();
    } else {
      // Password is incorrect, display error message
      $error = "Invalid password";
    }
  } else {
    // User does not exist, display error message
    $error = "Invalid TSC number or password";
  }

  // Close the database connection
  $conn->close();
}
