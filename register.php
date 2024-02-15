
<?php
function postDataRegister(){
  $formInputs = array('name', 'email', 'password', 'repeat');
  $formInputs[0] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs[1] = filter_input(INPUT_POST, $formInputs[1]);
  $formInputs[2] = filter_input(INPUT_POST, $formInputs[2]);
  $formInputs[3] = filter_input(INPUT_POST, $formInputs[3]);
  return $formInputs;
}

function formCheckRegister($formInputs = array('', '', '', '')){
   // array order is  name, email, password, repeat password
  $errors = array('', '', '', '');
  $emailExist = false;
  // I want to replace this with a relative path but php's routing doesn't work how I think
  $hardPath = 'D:\\xampp\\htdocs\\educom-webshop-basis-1707216396\\users\\users.txt';
  // first checking if passwords match because then the empty field warning can override it in case the passwords don't match because one is empty
  if ($formInputs[2] != $formInputs [3]){ $errors[2] = $errors[3] = "Wachtworden matchen niet"; }
  for ($x = 0; $x <= 3; $x++){
    $errors[$x] = checkFieldContent($formInputs[$x]);
  }
  $errors[1] = checkEmail($formInputs[1]);
  // And last, checking if email is in user.txt if there's no errors
  if ($errors == array('', '', '', '')){
    $emailExist = doesEmailExist($formInputs[1]);
  }
  var_dump($emailExist);
  if ($emailExist) {
    $errors[1] = "Deze mail is al in gebruik";
    }
  // next up is determening whether to go back to the register page or to file away the data and go to login
  // for this we can again check if there's an error messages present (be it missing info or mail being used already
  var_dump($errors);
  if ($errors == array('', '', '', '')){
    $errors = array('login');
    saveUser($formInputs[1], $formInputs[0], $formInputs[2]);
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



