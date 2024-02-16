
<?php
$servername = "localhost";
$username = "milan_lucas_web_shop";
$password = "kxFap1pG3rP3rGCT";
$dbName = 'milan_web_shop_users';
$conn = dbConnect($servername, $username, $password, $dbName);

dbConnect($conn);
//dbCreateDatabase($conn);
//dbCreateTable($conn);
  

function dbConnect($servername, $username, $password, $dbName){
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbName);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  return $conn;
}

function dbCreateDatabase($conn){
  // Create database
  $sql = "CREATE DATABASE milan_web_shop_users";
  if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($conn);
  }
  mysqli_close($conn);
}

function dbCreateTable($conn){
  $sql = "CREATE TABLE milan_webshop (
  email VARCHAR(50) NOT NULL PRIMARY KEY,
  user VARCHAR(30) NOT NULL,
  password VARCHAR(30) NOT NULL
  )";
  if (mysqli_query($conn, $sql)) {
    echo "Table milan_webshop created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
}


mysqli_close($conn);
?>



