
<?php
function getFilePath(){
  return 'users\\users.txt';
}
function findUserByEmail($email){
  $userInfo = NULL;
  $filePath = getFilePath();
  $users = fopen($filePath, 'r'); 
  while(!feof($users)) {
    $currentLine =  fgets($users) ;
    $currentLine = explode("|", $currentLine, 3);
    if ($currentLine[0] == $email){
        $userInfo = array('email' => $currentLineParts[0], 'name' => $currentLineParts[1], 
                           'password' => $currentLineParts[2]); 
    }
  }
  return $userInfo;
}

function saveUser($email, $name, $password){
  $filePath = getFilePath();
  $userData =  $email.'|'.$name.'|'.$password;
  $users = fopen($filePath, "a");
  fwrite($users, "\n");
  fwrite($users, $userData);
  fclose($users);
}


?>



