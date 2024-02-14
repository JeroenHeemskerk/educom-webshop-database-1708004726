
<?php
function postDataRegister(){
  $formInputs = array('email', 'password');
  $formInputs[0] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs[1] = filter_input(INPUT_POST, $formInputs[1]);
  return $formInputs;


function formCheckLogin($formInputs = array('', '')){
  $errors = array('', '');
  //first, lets check if there's any input
   for ($x = 0; $x <= 1; $x++){
    if(empty($formInputs[$x])) { $errors[$x] = "Dit veld moet nog ingevuld worden";} 
}



function showHeadLogin(){
  echo '<title>Login form</title>';
}

function showHeaderLogin(){
  echo '<header class=title><h1>De login pagina</h1></header>';
}

function showContentLogin($formInputs = array('', '' ), $errors = array('', '')){
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="login" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="name"> Email:</label> 
    <input type="text" name="email" value="'.$formInputs[0].'" id="email">
    <span class="error">* '.$errors[0].'</span>
  </div>
    <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs[1].'" id="password">
    <span class="error">* '.$errors[1].'</span>
  </div>
  <div>
    <label class = "hidden" for="submit"> hidden </label>
    <input type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}

?>




