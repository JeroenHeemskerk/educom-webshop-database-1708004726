
<?php
function postDataLogin(){
  $formInputs = array('email', 'password');
  $formInputs[0] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs[1] = filter_input(INPUT_POST, $formInputs[1]);
  return $formInputs;
}


function formCheckLogin($formInputs = array('', '')){
  $errors = array('', '');
  $hardPath = 'D:\\xampp\\htdocs\\educom-webshop-basis-1707216396\\users\\users.txt';
  //first, lets check if there's any input
   for ($x = 0; $x <= 1; $x++){
    if(empty($formInputs[$x])) { $errors[$x] = "Dit veld moet nog ingevuld worden";} 
  }  
  if ($errors == array('', '')){
    // and then you gotta check if it matches with anything in users.txt
    $users = fopen($hardPath, 'r');
    // okay what I need to do is loop through each line and check if the mail + password match at the same time 
      while(!feof($users)) {
        $currentLine =  fgets($users) ;
        $currentLine = explode('|', $currentLine);
        $email = $currentLine[0];
        $password = $currentLine[2];
        if ($email == $formInputs[0] && $password == $formInputs[1]){
          $_SESSION["loggedIn"] = true;
          $_SESSION["userName"] = $currentLine[1];
          return array('home');
        }
      }
      // So, if loggedIn = true, we would have already returned to the home page, but we haven't here. So, we gotta have an error for no login match
      $errors[0] = 'De email of wachtword is incorrect';
  }
  // You get here if you got any errors
  $errors = array_merge($errors, array('login'));
  return $errors;
}

function showHeadLogin(){
  echo '<title>Login form</title>';
}

function showHeaderLogin(){
  echo '<header class=title><h1>De login pagina</h1></header>';
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