
<?php
function checkFieldContent($data, $err=''){
  if (empty($data)) $err = "Dit veld moet ingevuld worden"; 
  return $err;
}

function checkEmail($email, $err=''){
  if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    $err = '';
  } else {
   $err = 'Dit is geen geldig email address';
  }
  return $err;
}

function checkPostalCode($postalCode, $err=''){
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (!preg_match($postRegex, $postalCode)) { 
      $err = "Dit is niet een nederlandse postcode";
    }
    return $err;
}

function checkPasswordMatch($password, $repeat){
  $match = false;
  if ($password == $repeat) {$match = true;}
  return $match;
}

?>



