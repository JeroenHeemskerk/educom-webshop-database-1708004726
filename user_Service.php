
<?php
function doesEmailExist($email){
  $exist = false;
  $userInfo = findUserByEmailDB($email);
  if (isset($userInfo)){ $exist = True; }
  return $exist;
}

function authenticateUser($email, $password){
  $authUser = false;
  $userInfo = findUserByEmailDB($email);
  //check if $password overlaps with the password in $userInfo
  if ($password == $userInfo['password']){ $authUser = $userInfo;}
  return $authUser;
  
}

?>



