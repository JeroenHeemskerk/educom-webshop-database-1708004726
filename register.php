
<?php
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
    <label for="password"> Herhaal het wachtword:</label> 
    <input type="text" name="password" value="'.$formInputs[3].'" id="password">
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



