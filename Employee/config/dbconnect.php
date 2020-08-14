<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "emp";
$conn = @mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if (mysqli_connect_errno()) {
  // Send Error message to index file
  sett("Problem Connecting to Database!","bg-danger");
  // die($conn);

  
}else{
  
  sett("","");
}

?>