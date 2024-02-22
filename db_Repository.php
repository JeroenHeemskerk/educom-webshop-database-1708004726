
<?php


//saveUserDB("test@tester.nl", "Dickens", "PutMeInCoach");
function dbConnect(){
  $servername = "localhost";
  $username = "milan_lucas_web_shop";
  $password = "cNLN0whG56mamGYq";
  $dbName = 'milan_web_shop_users';
  // Create connection
  try{
    $conn = mysqli_connect($servername, $username, $password, $dbName); 
    
    //replace above with throw later
    // Check connection
    if (!$conn) {
      throw new Exception("Cannot connect to database". mysqli_error());
    }
    return $conn;
  }
  // refuses to function without finally
  finally {

  }
}


function saveUserDB($email, $user, $password){
  $conn = dbConnect(); 
  try {
    $email = mysqli_real_escape_string($conn, $email);
    $user = mysqli_real_escape_string($conn, $user);
    $password = mysqli_real_escape_string($conn, $password);
    $sql = "INSERT INTO users (email, user, password)
    VALUES ('".$email."', '".$user."', '".$password."')";
    if (!mysqli_query($conn, $sql)) {
        throw new Exception ("Cannot insert into users". mysqli_error());
    }
  }
  finally {
  dbDisconnect($conn);
  }
}


function findUserByEmailDB($email){
  $conn = dbConnect();
  
  try {
  $email = mysqli_real_escape_string($conn, $email);
  $sql = 'SELECT * FROM users WHERE email="'.$email.'"';
  $result = mysqli_query($conn, $sql);
    if(!$result){
      throw new Exception('Query find user by email failed'. msqli_error());
    }
    return mysqli_fetch_assoc($result);
  } 
  
  finally {
    dbDisconnect($conn);
  }
}

function updateUserPasswordDB($email, $password){
  $conn = dbConnect();
  $sql = 'UPDATE users 
  SET password="'.$password.'"
  WHERE email="'.$email.'"';
  try {
    if (!mysqli_query($conn, $sql)){
      throw new Exception('Update user password failed'. msqli_error());
    }
  }
  finally {
    dbDisconnect($conn);
  }
}

function dbDisconnect($conn){ 
  mysqli_close($conn); 
}

function getItemsFromDB($select = '*', $from = 'products', $where = '' ){
  $conn = dbConnect();
  $sql = 'SELECT '.$select.'
  FROM '.$from.''; 
  if ($where){
    $sql = $sql.' WHERE '.$where;
  }
  try {

    $result = mysqli_query($conn, $sql);
    if (!$result){
      throw new Exception('Retrieving info from db failed'. msqli_error());
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
  
  finally {
    dbDisconnect($conn);
  }

}

function placeOrderDB(){
  //I did not save user ID into the session, which means I have to get it through a query
  $email = getSessionEmail();
  $userData = findUserByEmailDB($email);
  $userId = $userData['id'];
  $orderId = insertInOrder($userId);
  insertOrderInOrdersContent($orderId);
  // and once we get here, it means the order was succesfully placed, thus we can clear the basked
  
  makeCart();
  

}

function insertInOrder($userId){
  $conn = dbConnect();
  // when inserting an order, I also want to return under which id the order is saved
  // also need the current date 
  $date = date('Y-m-d');
  $sql = 'INSERT INTO orders (user_id, date) VALUES ('.$userId.', "'.$date.'")';
  try {
    if (!mysqli_query($conn, $sql)) {
      throw new Exception('Insert into orders failed'. msqli_error());
    } 
  return mysqli_insert_id($conn);
  }
  finally {
    dbDisconnect($conn);
  }

}

function insertOrderinOrdersContent($orderId){
  $conn = dbConnect();
  // Need to know what is in the basket for this
  $basket = getSessionBasket();
  var_dump($basket);
  // I want to create a big insert query for all sets of values
  // the base of the query at least is
  $sql = 'INSERT INTO orders_content (order_id, product_id, product_count) VALUES';
  // then I'd need to loop through the basket again to get product ids and counts
  foreach ($basket as $product => $count){
    if ($count != 0) {
      $sqlAddition = '('.$orderId.', '.$product.', '.$count.'),';
      $sql = $sql.$sqlAddition;
    }
  }
  // this way we end with a , at the end
  $sql = substr($sql, 0, -1);
  // and replace it with a ;
  $sql = $sql.';';
  try{
    if(!mysqli_query($conn, $sql)){
      throw new Exception('Insert into order content failed'. msqli_error());
    }
  }

  finally {
    dbDisconnect($conn);
  }
}

function getTopItemsDB(){
  $conn = dbConnect();
  $sql = 
  "SELECT orders_content.product_id, sum(orders_content.product_count) AS 'product_counts' 
  FROM orders LEFT JOIN orders_content on orders_content.order_id = orders.id
  WHERE date BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now() 
  GROUP BY orders_content.product_id 
  ORDER BY product_counts DESC LIMIT 5; ";
  try {
    $result = mysqli_query($conn, $sql);
    if (!$result){
      throw new Exception('Retrieving info from db failed'. msqli_error());
    }
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
   }
   finally {
    dbDisconnect($conn);
  }
}


?>



