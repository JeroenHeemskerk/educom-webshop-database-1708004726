
<?php

function postDataLogin(){
  $formInputs = array('email', 'password');
  $formInputs[0] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs[1] = filter_input(INPUT_POST, $formInputs[1]);
  return $formInputs;
}


function formCheckLogin($formInputs = array('', '')){
  // array is mail, password
  $errors = array('', '');
  $userAuth = false;
  //first, lets check if there's any input
   for ($x = 0; $x <= 1; $x++){
    $errors[$x] = checkFieldContent($formInputs[$x]);
  }    
  if ($errors == array('', '')){
    $userAuth = authenticateUser($formInputs[0], $formInputs[1]);
    if ($userAuth){
      doLoginUser($userAuth['user']);
      return array('home');
    }
  }
  // So, if userAuth = true, we would have already returned to the home page, but we haven't here. So, we gotta have an error for no login match
  $errors[0] = 'De email of wachtword is incorrect';
  // You get here if you got any errors
  $errors = array_merge($errors, array('login'));
  return $errors;
}

function showHeadLogin(){
  echo '<title>Login form</title>';
}

function showHeaderLogin(){
  echo '<header class=title><h1>Login</h1></header>';
}

function showContentLogin($formInputs = array('', '', '', '')){
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="login" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs[0].'" id="email">
    <span class="error">* '.$formInputs[2].'</span>
  </div>
    <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs[1].'" id="password">
    <span class="error">* '.$formInputs[3].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>