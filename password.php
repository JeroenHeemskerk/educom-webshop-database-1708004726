
<?php
function postDataPassword(){
  //var_dump($formInputs);
  $formInputs['oldPass'] = getPostVar('oldPass');
  $formInputs['newPass'] = getPostVar('newPass');
  $formInputs['repeatNewPass'] = getPostVar('repeatNewPass');
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
  // gotta start incorperating assocative arrays
  $errors = array('oldPass'=> '', 'newPass'=>'', 'repeatNewPass'=>'');
  $userAuth = false;
 //first checking if they have content
  foreach ($formInputs as $x => $y) {
    $errors[$x] = checkFieldContent($y); 
  }
  // If any field is empty, it is pointless to continue the checks
  // we can check for this by checking if any error message is filled
  $errorFlag = false;
  foreach ($errors as $x => $y){
    if ($y) {$errorFlag = true ;}
  }
    
  // check if new passwords match
  $passMatch = checkPasswordMatch($formInputs['newPass'], $formInputs['repeatNewPass']);
  if (!$passMatch){
    $errors['newPass']='De wachtwoorden zijn niet hetzelfde';
    $errorFlag = True; }
  
  // so there is no errorFlag, which means we have to authenticate the user and if the password is correct
  if(!$errorFlag) {
    // For this we need the user Email in addition to the password
    $email = getSessionEmail();
    $userAuth = authenticateUser($email, $formInputs['oldPass']);
    if ($userAuth){
      // if its authenticated, we have to do two things, change the password 
      updateUserPassword($email, $formInputs['newPass']);
      //and show that it has been changed
      $errors['oldPass'] = 'Wachtwoord is geupdate';
    } else { 
    // or if the user isn't authenticated, it means the password is wrong
      $errors['oldPass'] = 'Wachtwoord is incorrect';
    }
  }
  
  //at the end we gotta do two things (if there is an error)
  // redirect back to the password page & set back to an indexed array for functionality
  $errors['page'] = 'password';
  return $errors;

}

function showContentPassword($formInputs){
  // array is only for warnings
  // warning old pass, warning new pass
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="password" id="page"/>
  <fieldset class="persoon">
  <div> 
    <label for="oldPass">Oude wachtwoord:</label> 
    <input type="text" name="oldPass" value="" id="oldPass">
    <span class="error">* '.$formInputs['oldPass'].'</span>
  </div>
    <div> 
    <label for="newPass"> Nieuw wachtwoord:</label> 
    <input type="text" name="newPass" value="" id="newPass">
    <span class="error">* '.$formInputs['newPass'].'</span>
  </div>
    <div> 
    <label for="repeatNewPass"> Herhaal nieuw wachtwoord:</label> 
    <input type="text" name="repeatNewPass" value="" id="repeatNewPass">
    <span class="error">* '.$formInputs['repeatNewPass'].'</span>
  </div>
  <div>
    <input class = "submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form>';
}


?>



