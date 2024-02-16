
<?php
function postDataPassword(){
  $formInputs = array('oldPass' => 'oldPass', 'newPass' => 'newPass', 'repeatNewPass' => 'repeatNewPass');
  //var_dump($formInputs);
  $formInputs['oldPass'] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs['newPass'] = filter_input(INPUT_POST, $formInputs[1]);
  $formInputs['repeatNewPass'] = filter_input(INPUT_POST, $formInputs[2]);
  return $formInputs;
}


function showHeadPassword(){
  echo '<title> Changing password </title>';
}

function showHeaderPassword(){
  echo '<header class=title><h1> Verander hier uw wachtword </h1></header>';
}

function formCheckPasswords($formInputs) {
  // Check whether old password is accurate, new passwords match, and no fields are empty
  $errors = array('oldPassErr'=> '', 'newPassErr'=>'', 'repeatNewPassErr'=>'');
  // gotta start incorperating assocative arrays
  // check if new passwords match
  $passMatch = checkPasswordMatch($formInputs['newPass'], $formInputs['repeatNewPass']);
  if (!passMatch){$errors['newPassErr']='De wachtwoorden zijn niet hetzelfde';}
}

function showContentPassword($formInputs=array('oldPassErr'=> '', 'newPassErr'=>'', 'repeatNewPassErr'=>'')){
  // array is only for warnings
  // warning old pass, warning new pass
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="password" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="oldPass">Oude wachtwoord:</label> 
    <input type="text" name="oldPass" value="" id="oldPass">
    <span class="error">* '.$formInputs['oldPassErr'].'</span>
  </div>
    <div> 
    <label for="newPass"> Nieuw wachtwoord:</label> 
    <input type="text" name="newPass" value="" id="newPass">
    <span class="error">* '.$formInputs['newPassErr'].'</span>
  </div>
    <div> 
    <label for="repeatNewPass"> Herhaal nieuw wachtwoord:</label> 
    <input type="text" name="repeatNewPass" value="" id="repeatNewPass">
    <span class="error">* '.$formInputs['repeatNewPassErr'].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}


?>



