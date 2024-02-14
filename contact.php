
<?php
function showHeadContact(){
  echo '<title>Contact form</title>';
}

function showHeaderContact(){
  echo '<header  class=title><h1>De contact pagina van Milan Lucas</h1></header>';
}

function showContentContactForm($formInputs = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '')){
  // order of arrays is title, name, email, phonenumber, street, housenumber, postalcode, city, message, communication (repeating once after communication)
  $title = array('', '', '');
  $communication = array('', '', '');
  switch($formInputs[0]){
    case ('sir');
      $title[0] = 'selected';
      break;
    case ('madam');
      $title[1] = 'selected';
      break;
    case ('other');
      $title[2] = 'selected';
      break;
  }
   switch($formInputs[8]){
    case ('email');
      $communication[0] = 'checked';
      break;
    case ('phone');
      $communication[1] = 'checked';
      break;
    case ('post');
      $communication[2] = 'checked';
      break;
  }
  
  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="contact" id="page"/>
  <fieldset class="persoon">
  <div>
  <label for="title">title:</label> 
  <select id="title" name="title">
    <option value=""></option>
    <option value="sir" '.$title[0].' >Dhr.</option> 
    <option value="madam" '.$title[1].' >Mvr.</option>
    <option value="other" '.$title[2].'>Anders</option>
  </select> 
    <span class="error">* '.$formInputs[10].'</span>
  </div>
  <div>
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs[1].'" id="name">
    <span class="error">* '.$formInputs[11].'</span>
  </div>
  <div>
    <label for="email">E-mail:</label> 
      <input type="text" name="email" value="'.$formInputs[2].'" id="email">
    <span class="error"> '.$formInputs[12].'</span>
  </div>
  <div>
    <label for="phonenumber">Telefoon nummer:</label> 
    <input type="text" name="phonenumber" value="'.$formInputs[3].'" id="phonenumber">
    <span class="error"> '.$formInputs[13].'</span>
  </div>
  <div>
    <label for="street">Straat:</label> 
    <input type="text" name="street" value="'.$formInputs[4].'" id="street">
    <span class="error"> '.$formInputs[14].'</span>
  </div>
  <div>
    <label for="housenumber">Huisnummer:</label> 
    <input type="text" name="housenumber" value="' .$formInputs[5].'" id="housenumber">
    <span class="error"> '.$formInputs[15].'</span>
  </div>
  <div>
    <label for="postalcode">Postcode:</label> 
    <input type="text" name="postalcode" value="'.$formInputs[6].'" id="postalcode">
    <span class="error"> '.$formInputs[16].'</span>
  </div>
  <div>
    <label for="city">Woonplaats:</label> 
    <input type="text" name="city" value="' .$formInputs[7].'" id="city">
    <span class="error">'.$formInputs[17].'</span>
  </div>

    <!-- Voorkeur communication -->
  <fieldset class = "communication">
     <legend>Hoe wilt u communiceren?</legend> 
      <span class="error">* '.$formInputs[18].'</span>
      <div>
      <input type="radio" name="communication" value="email" '.$communication[0].' >  
      <label for="email">Email</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="phone"  '.$communication[1].' >
      <label for="phone">Telefoon</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="post"  '.$communication[2].' > 
     
      <label for="post">Post</label>
      </div>
       
     </legend>
    </fieldset>

    <!-- reden van contact -->
  <div>
    <label for="message">Waarom wilt u contact opnemen?</label>
    <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$formInputs[9].'" ></textarea>
    <span class="error">* '.$formInputs[19].'</span>
  </div>
  <div>
    <label class = "hidden" for="submit"> hidden </label>
    <input type="submit" value="Submit">
  </div>
    </fieldset>
  </form> 
  ';
}

function postDataContact(){
  $formInputs = array('title', 'name', 'email', 'phonenumber', 'street', 'housenumber', 'postalcode', 'city', 'communication', 'message');
  $formInputs[0] = filter_input(INPUT_POST, $formInputs[0]);
  $formInputs[1] = filter_input(INPUT_POST, $formInputs[1]);
  $formInputs[2] = filter_input(INPUT_POST, $formInputs[2]);
  $formInputs[3] = filter_input(INPUT_POST, $formInputs[3]);
  $formInputs[4] = filter_input(INPUT_POST, $formInputs[4]);
  $formInputs[5] = filter_input(INPUT_POST, $formInputs[5]);
  $formInputs[6] = filter_input(INPUT_POST, $formInputs[6]);
  $formInputs[7] = filter_input(INPUT_POST, $formInputs[7]);
  $formInputs[8] = filter_input(INPUT_POST, $formInputs[8]);
  $formInputs[9] = filter_input(INPUT_POST, $formInputs[9]);
  return $formInputs;
}

function formCheckContact($formInputs = array('', '', '', '', '', '', '', '', '', '')) {
  // Order of arrays should be: title, name, email, phonenumber, street, housenumber, postalcode, city, communication, message
  $errors = array('', '', '', '', '', '', '', '', '', '');
  $valid = false;
  $postRequired = false;
	//Ordered the same way the form is in
  // so this is the title
  $errors[0] = dataPresent($formInputs[0], $errors[0]);
  // the name
  $errors[1] = dataPresent($formInputs[1], $errors[1]);
  // the message
  $errors[9] = dataPresent($formInputs[9], $errors[9]);
  // the communication method
  $errors[8] = dataPresent($formInputs[8], $errors[8]);
  
  if ($formInputs[8] == "email") {
    $errors[2] = dataPresent($formInputs[2], $errors[2]);
  } elseif ($formInputs[8] == "phone") {
    $errors[3] = dataPresent($formInputs[3], $errors[3]);
  } elseif ($formInputs[8] == "post"){
    $postRequired = true;
  }
  
  $postData = array($formInputs[4], $formInputs[5], $formInputs[6], $formInputs[7]);
  foreach ($postData as $x) {
    if ($x != '') {
      $postRequired = true;
    }
  }
    
  if ($postRequired) {
    //Validating postal code
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (!preg_match($postRegex, $formInputs[6])) { 
      $postalcodeErr = "Dit is niet een nederlandse postcode";
    }
    //street
    $errors[4] = dataPresent($formInputs[4], $errors[4]);
    //housenumber
    $errors[5] = dataPresent($formInputs[5], $errors[5]);
    //postalcode
    $errors[6] = dataPresent($formInputs[6], $errors[6]);
    //city
    $errors[7] = dataPresent($formInputs[7], $errors[7]);
    
  }
  //Validity check, first check if everything is the same, if it is, check if nameErr is empty because it means there's no errors
  // actually might not be necessary to check nameErr, because under no circumstances are all fields required
  $valid = (count(array_unique($errors, SORT_REGULAR)) == 1);
  if ($valid == 'true'){
    // the thanks is the page to redirect to, the error messages are unneeded since the input is valid
    return array('thanks');
  } 
  // otherwise it should circle back with data to fill the og page, which means including the page name to link back to
  $errors = array_merge($errors, array('contact'));
  return $errors;
}

function dataPresent($data, $err='') {
  if (empty($data)) $err = "Dit veld moet nog ingevuld worden"; 
  return $err;
}

function showContentThanks($formInputs = array('', '', '', '', '', '', '', '', '', '')){
  // changing phone to telefoon for the display 
  if ($formInputs[8] == 'phone'){
    $formInputs[8] = 'telefoon';
  }
 
  echo '<p>Bedankt voor uw reactie:</p> 
  <div>Naam: '.$formInputs[1].'</div>
  <div>Email: '.$formInputs[2].'</div>
  <div>Telefoon: '.$formInputs[3].'</div>
  <div>Straat: '.$formInputs[4].'</div>
  <div>Huisnummer: '.$formInputs[5].'</div>
  <div>Postcode: '.$formInputs[6].'</div>
  <div>Woonplaats: '.$formInputs[7].'</div>
  <div>Communicatie voorkeur: '.$formInputs[8].'</div>';
}

?>
