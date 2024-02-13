
<?php

function showHeadLogin(){
  echo '<title>Login form</title>';
}

function showHeaderLogin(){
  echo '<header class=title><h1>De login pagina</h1></header>';
}

function showContentLogin($formInputs = array('', '' ), $errors = array('', '')){
  echo '
  <form class="contact" method="POST" action="index.php">
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




