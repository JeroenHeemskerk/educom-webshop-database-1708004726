
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
  } catch(\Exception $e) {$conn = false;}
  // Check connection
  //if (!$conn) {
  //  die("Connection failed: " . mysqli_connect_error());
  //}
  return $conn;
}

function dbCreateDatabase(){
  $conn = dbConnect(); 
  // Create database
  $sql = "CREATE DATABASE milan_web_shop_users";
  if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
  } else {
    echo "Error creating database: " . mysqli_error($conn);
  }
  dbDisconnect($conn);
}

function dbCreateTable(){
  $conn = dbConnect(); 
  $sql = "CREATE TABLE milan_webshop (
  email VARCHAR(50) NOT NULL PRIMARY KEY,
  user VARCHAR(30) NOT NULL,
  password VARCHAR(60) NOT NULL
  )";
  if (mysqli_query($conn, $sql)) {
    echo "Table milan_webshop created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
  dbDisconnect($conn);
}

function saveUserDB($email, $user, $password){
  $conn = dbConnect(); 
  $sql = "INSERT INTO milan_webshop (email, user, password)
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
  $sql = 'SELECT * FROM milan_webshop WHERE email="'.$email.'"';
  $result = mysqli_query($conn, $sql);
  return mysqli_fetch_assoc($result);

}

function dbDisconnect($conn){ 
  mysqli_close($conn); 
}

?>



