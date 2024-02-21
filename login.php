
<?php

function postDataLogin(){
  $formInputs['email'] = getPostVar("email");
  $formInputs['password'] = getPostVar("password");
  return $formInputs;
}


function formCheckLogin($formInputs){
  // array is mail, password
  $errors = array('emailErr' => '', 'passwordErr' => '');
  $userAuth = false;
  $userData = '';
  //first, lets check if there's any input
  $errors['emailErr'] = checkFieldContent($formInputs['email']);
  $errors['passwordErr'] = checkFieldContent($formInputs['password']);
  // check if there is an error message present
  if (!$errors['emailErr'] || !$errors['passwordErr']){

    try {
    $userData = authenticateUser($formInputs['email'], $formInputs['password']);
    doLoginUser($userData['user'], $userData['email']);
    $errors['page']= 'home';
    return  $errors;
    } catch (exception $e) {
      $errors['emailErr'] = 'Er is een probleem met de server, probeer later nog eens';
      logErrors('Connection failed'.$e);
    }
    // check if there is anything in user data (if there is, it means the user can be logged in)
    
  }
  // It gets here if either an input was blank or something was wrong
  // so check the inputs again
  if (!$errors['emailErr'] && !$errors['passwordErr']){
    $errors['emailErr'] = 'De email of wachtword is incorrect';
  }
  $errors['page'] = 'login';
  return $errors;
}

function showHeadLogin(){
  echo '<title>Login form</title>';
}

function showHeaderLogin(){
  echo '<header class=title><h1>Login</h1></header>';
}

function showContentLogin($formInputs){
  var_dump($formInputs);
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="login" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
    <span class="error">* '.$formInputs['emailErr'].'</span>
  </div>
    <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs['password'].'" id="password">
    <span class="error">* '.$formInputs['passwordErr'].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>