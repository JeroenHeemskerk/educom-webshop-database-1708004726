
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
  $errors = array('', '', '', '');
  // I want to replace this with a relative path but php's routing doesn't work how I think
  $hardPath = 'D:\\xampp\\htdocs\\educom-webshop-basis-1707216396\\users\\users.txt';
  // first checking if passwords match because then the empty field warning can override it in case the passwords don't match because one is empty
  if ($formInputs[2] != $formInputs [3]){ $errors[2] = $errors[3] = "Wachtworden matchen niet"; }
  for ($x = 0; $x <= 3; $x++){
    if(empty($formInputs[$x])) { $errors[$x] = "Dit veld moet nog ingevuld worden";} 
  }
  // And last, checking if email is in user.txt
    if ($errors == array('', '', '', '')){

      $users = fopen($hardPath, 'r');
    // okay what I need to do is loop through each line and check if the mail matches anywhere
      while(!feof($users)) {
        $currentLine =  fgets($users) ;
        echo $currentLine;
        $email = explode("|", $currentLine, 2)[0];
        if ($formInputs[0] == $email){
          $errors[0] = "Deze mail is al in gebruik";
         }
      }
      fclose($users);
    }
  // next up is determening whether to go back to the register page or to file away the data and go to login
  // for this we can again check if there's an error messages present (be it missing info or mail being used already
  if ($errors == array('', '', '', '')){
    // in this case nothing is missing
    // so we can turn our error array into just 'login' for page redirection
    $errors = array('login');
    // then we make a string to write away into users.txt
    $userData =  $formInputs[0].'|'.$formInputs[1].'|'.$formInputs[2];
    $users = fopen($hardPath, "a");
    fwrite($users, "\n");
    fwrite($users, $userData);
    fclose($users);
  } else {
      $errors = array_merge($errors, array('register'));
  }
  return $errors;
}

function showHeadRegister(){
  echo '<title>Register form</title>';
}

function showHeaderRegister(){
  echo '<header  class=title><h1>De registratie pagina</h1></header>';
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
    <label class = "hidden" for="submit"> hidden </label>
    <input type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>



