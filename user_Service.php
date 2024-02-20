
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
  //userInfo is only null if there was an error in the database
  // otherwise its an array
  if (!isset($userInfo)){
    return $userInfo;}
  //check if $password overlaps with the password in $userInfo
  if (passwordDecrypt($password, $userInfo['password'])){ $authUser = $userInfo;}
  return $authUser;
}

function passwordDecrypt($password, $hash){
  return password_verify($password, $hash);
}

function passwordEncrypt($password){
  return password_hash($password, PASSWORD_BCRYPT, ['cost' => 14]);
}

function saveUser($email, $user, $password){
  $password = passwordEncrypt($password);
  saveUserDB($email, $user, $password);
}

function updateUserPassword($email, $password){
  // have to encrypt the password
  $password = passwordEncrypt($password); 
  updateUserPasswordDB($email, $password);
}




?>



