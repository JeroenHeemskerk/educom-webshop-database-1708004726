
<?php


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
  //replace above with throw later
  // Check connection
  //if (!$conn) {
  //  die("Connection failed: " . mysqli_connect_error());
  //}
  return $conn;
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

function getItemsFromDB($select = '*', $from = 'products', $where = '' ){
  $conn = dbConnect();
  if (!$conn) {
    return $conn;
  }
  $sql = 'SELECT '.$select.'
  FROM '.$from.''; 
  if ($where){
    $sql = $sql.' WHERE '.$where;
  }
  $result = mysqli_query($conn, $sql);
  dbDisconnect($conn);
  // Functional but feels like it could get problematic
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function placeOrderDB(){
  //I did not save user ID into the session, which means I have to get it through a query
  // so I need an unique key 
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
  var_dump($sql);
  if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
  } 
  dbDisconnect($conn);
  return $last_id;


}

function insertOrderinOrdersContent($orderId){
  $conn = dbConnect();
  // Need to know what is in the basket for this
  $basket = getSessionBasket();
  // I want to create a big insert query for all sets of values
  // the base of the query at least is
  $sql = 'INSERT INTO orders_content (order_id, product_id, product_count) VALUES';
  // then I'd need to loop through the basket again to get product ids and counts
  foreach ($basket as $product => $count){
    if ($count != 0) {
      // product is product id but has a 0 in front, gotta remove that
      $productId = substr($product, 1);
      $sqlAddition = '('.$orderId.', '.$productId.', '.$count.'),';
      $sql = $sql.$sqlAddition;
    }
  }
  // this way we end with a , at the end
  $sql = substr($sql, 0, -1);
  // and replace it with a ;
  $sql = $sql.';';
  mysqli_query($conn, $sql);
  dbDisconnect($conn);
}


?>



