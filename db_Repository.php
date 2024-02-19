
<?php

//dbCreateDatabase($conn);
//dbCreateTable($conn);
//saveUserDB("test@tester.nl", "Dickens", "PutMeInCoach");
function dbConnect(){
  $servername = "localhost";
  $username = "milan_lucas_web_shop";
  $password = "cNLN0whG56mamGYq";
  $dbName = 'milan_web_shop_users';
  // Create connection
  try {
  $conn = mysqli_connect($servername, $username, $password, $dbName); 
  } catch(\Exception $e) {$conn = NULL;}
  // Check connection
  //if (!$conn) {
  //  die("Connection failed: " . mysqli_connect_error());
  //}
  return $conn;
}

function dbCreateDatabase(){
  $conn = dbConnect(); 
  // Create database
  $sql = "CREATE DATABASE users";
  if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($conn);
  }
  dbDisconnect($conn);
}

function dbCreateTable(){
  $conn = dbConnect(); 
  $sql = "CREATE TABLE users (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(50) NOT NULL UNIQUE,
  user VARCHAR(30) NOT NULL,
  password VARCHAR(60) NOT NULL
  )";
  if (mysqli_query($conn, $sql)) {
    echo "Table milan_webshop_users created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
  dbDisconnect($conn);
}

function saveUserDB($email, $user, $password){
  $conn = dbConnect(); 
  if (!$conn) {
    return $conn;
  }
  $sql = "INSERT INTO users (email, user, password)
  VALUES ('".$email."', '".$user."', '".$password."')";
  if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  } else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  dbDisconnect($conn);
}


function findUserByEmailDB($email){
  $conn = dbConnect();
  if (!$conn) {
    return $conn;
  }
  $sql = 'SELECT * FROM users WHERE email="'.$email.'"';
  $result = mysqli_query($conn, $sql);
  dbDisconnect($conn);
  return mysqli_fetch_assoc($result);
}

function updateUserPasswordDB($email, $password){
  $conn = dbConnect();
  if (!$conn) { return $conn;}
  $sql = 'UPDATE users 
  SET password="'.$password.'"
  WHERE email="'.$email.'"';
  mysqli_query($conn, $sql);
}

function dbDisconnect($conn){ 
  mysqli_close($conn); 
}

?>



