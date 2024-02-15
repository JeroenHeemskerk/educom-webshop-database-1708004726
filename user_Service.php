
<?php
function doesEmailExist($email){
  $exist = false;
  $userInfo = findUserByEmail($email);
  var_dump($userInfo);
  if ($userInfo != ''){ $exist = True; }
  return $exist;
}

function authenticateUser($user, $password){}

?>



