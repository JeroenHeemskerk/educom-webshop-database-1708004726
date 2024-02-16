
<?php
function showHeadPassword(){
  echo '<title> Changing password </title>';
}

function showHeaderPassword(){
  echo '<header class=title><h1> Verander hier uw wachtword </h1></header>';
}

function showContentPassword(){
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="password" value="login" id="password"/>
  <fieldset class="persoon">
  <div> 
    <label for="oldPass">Oude wachtwoord:</label> 
    <input type="text" name="oldPass" value="'.$formInputs[0].'" id="oldPass">
    <span class="error">* '.$formInputs[1].'</span>
  </div>
    <div> 
    <label for="password"> Wachtword:</label> 
    <input type="text" name="password" value="" id="password">
    <span class="error">* '.$formInputs[2].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}


?>



