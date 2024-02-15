
<?php
function doesEmailExist($email){
  var_dump($email);
  $exist = false;
  $userInfo = findUserByEmail($email);
  var_dump($userInfo);
  if (isset($userInfo)){ $exist = True; }
  return $exist;
}

function authenticateUser($email, $password){
  $authUser = false;
  $userInfo = findUserByEmail($email);
  //check if $password overlaps with the password in $userInfo
  var_dump($userInfo);
  if ($password == $userInfo[2]){ $authUser = $userInfo;}
  return $authUser;
  
}

?>



