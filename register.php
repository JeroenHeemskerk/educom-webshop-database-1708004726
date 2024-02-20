
<?php
function postDataRegister(){
  $formInputs['name'] = getPostVar('name');
  $formInputs['email'] = getPostVar('email');
  $formInputs['password'] = getPostVar('password');;
  $formInputs['repeat'] = getPostVar('repeat');
  return $formInputs;
}

function formCheckRegister($formInputs ){
   // array order is  name, email, password, repeat password
  $errors = array('nameErr' => '', 'emailErr' => '', 'passwordErr' => '', 'repeatErr' => '');
  $emailExist = false;
  $passwordMatch = checkPasswordMatch($formInputs['password'],$formInputs['repeat']);

  $errors['nameErr'] = checkFieldContent($formInputs['name']);
  $errors['emailErr'] = checkFieldContent($formInputs['email']);
  $errors['passwordErr'] = checkFieldContent($formInputs['password']);
  $errors['repeatErr'] = checkFieldContent($formInputs['repeat']);

  /*for ($x = 0; $x <= 3; $x++){
    $errors[$x] = checkFieldContent($formInputs[$x]);
  } */
  // checking if the email is valid
  $errors['emailErr'] = checkEmail($formInputs['email']);
  // checking if the passwords match
  if (empty($passwordMatch)){
    $errors['passwordErr'] = $errors['repeatErr'] = "Wachtworden matchen niet";} 
  
  $emailExist = doesEmailExist($formInputs['email']);

  if ($emailExist) {
    $errors[1] = "Deze mail is al in gebruik";
    }
  // next up is determening whether to go back to the register page or to file away the data and go to login
  // so for this email can't already be registered, and passwords have to match
  if ($passwordMatch && !$emailExist){
    $errors = array('login');
    saveUser($formInputs['email'], $formInputs['name'], $formInputs['password']);
  } else {
      $errors = array_merge($errors, array('register'));
  }
  return $errors;
}

function showHeadRegister(){
  echo '<title>Register form</title>';
}

function showHeaderRegister(){
  echo '<header  class=title><h1>Registratie</h1></header>';
}

function showContentRegister($formInputs){
  echo '
  <form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="register" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs[0].'" id="name">
    <span class="error">* '.$formInputs[4].'</span>
  </div>
  <div> 
    <label for="email"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs[1].'" id="email">
    <span class="error">* '.$formInputs[5].'</span>
  </div>
  <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs[2].'" id="password">
    <span class="error">* '.$formInputs[6].'</span>
  </div>
  <div> 
    <label for="repeat"> Herhaal het wachtword:</label> 
    <input type="text" name="repeat" value="'.$formInputs[3].'" id="repeat">
    <span class="error">* '.$formInputs[7].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>



