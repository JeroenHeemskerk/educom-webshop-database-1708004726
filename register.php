
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
  // first checking if passwords match because then the empty field warning can override it in case the passwords don't match because one is empty
  if ($formInputs[2] != $formInputs [3]){ $errors[2] = $errors[3] = "Wachtworden matchen niet"; }
  for ($x = 0; $x <= 3; $x++){
    if(empty($formInputs[$x])) { $errors[$x] = "Dit veld moet nog ingevuld worden";} 
  }
  var_dump($errors);
  // And last, checking if email is in user.txt
  $hardPath = 'D:\\xampp\\htdocs\\educom-webshop-basis-1707216396\\users\\users.txt'; 
  $users = fopen($hardPath, 'r');
  echo fread($users, filesize($hardPath));
  fclose($users);
  
}

function showHeadRegister(){
  echo '<title>Register form</title>';
}

function showHeaderRegister(){
  echo '<header  class=title><h1>De registratie pagina</h1></header>';
}

function showContentRegister($formInputs = array('', '' ,'', ''), $errors = array('', '', '', '')){
  echo '
  <form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="register" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs[0].'" id="name">
    <span class="error">* '.$errors[0].'</span>
  </div>
  <div> 
    <label for="email"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs[1].'" id="email">
    <span class="error">* '.$errors[1].'</span>
  </div>
  <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs[2].'" id="password">
    <span class="error">* '.$errors[2].'</span>
  </div>
  <div> 
    <label for="repeat"> Herhaal het wachtword:</label> 
    <input type="text" name="repeat" value="'.$formInputs[3].'" id="repeat">
    <span class="error">* '.$errors[3].'</span>
  </div>
  <div>
    <label class = "hidden" for="submit"> hidden </label>
    <input type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>



