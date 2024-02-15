
<?php
function setFilePath(){
  return 'users\\users.txt';
}
function findUserByEmail($email){
  $userInfo = '';
  $filePath = setFilePath();
  $users = fopen($filePath, 'r');
  while(!feof($users)) {
    $currentLine =  fgets($users) ;
    $currentLine = explode("|", $currentLine, -1);
    if ($currentLine[0] == $email){
      var_dump($currentLine);
      var_dump($email);
        $userInfo = $currentLine;
    }
  }
  return $userInfo;
}

function saveUser($email, $name, $password){
  $filePath = setFilePath();
  $userData =  $email.'|'.$name.'|'.$password;
  $users = fopen($filePath, "a");
  fwrite($users, "\n");
  fwrite($users, $userData);
  fclose($users);;
}


?>



