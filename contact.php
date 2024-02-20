
<?php
function showHeadContact(){
  echo '<title>Contact form</title>';
}

function showHeaderContact(){
  echo '<header  class=title><h1>Contact</h1></header>';
}

function showContentContact($formInputs){
  // order of arrays is title, name, email, phonenumber, street, housenumber, postalcode, city, message, communication (repeating once after communication)
  $title = array('', '', '');
  $communication = array('', '', '');
  switch($formInputs['title']){
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
   switch($formInputs['communication']){
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
    <span class="error">* '.$formInputs['titleErr'].'</span>
  </div>
  <div>
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$formInputs['name'].'" id="name">
    <span class="error">* '.$formInputs['nameErr'].'</span>
  </div>
  <div>
    <label for="email">E-mail:</label> 
      <input type="text" name="email" value="'.$formInputs['email'].'" id="email">
    <span class="error"> '.$formInputs['emailErr'].'</span>
  </div>
  <div>
    <label for="phonenumber">Telefoon nummer:</label> 
    <input type="text" name="phonenumber" value="'.$formInputs['phonenumber'].'" id="phonenumber">
    <span class="error"> '.$formInputs['phonenumberErr'].'</span>
  </div>
  <div>
    <label for="street">Straat:</label> 
    <input type="text" name="street" value="'.$formInputs['street'].'" id="street">
    <span class="error"> '.$formInputs['streetErr'].'</span>
  </div>
  <div>
    <label for="housenumber">Huisnummer:</label> 
    <input type="text" name="housenumber" value="' .$formInputs['housenumber'].'" id="housenumber">
    <span class="error"> '.$formInputs['housenumberErr'].'</span>
  </div>
  <div>
    <label for="postalcode">Postcode:</label> 
    <input type="text" name="postalcode" value="'.$formInputs['postalcode'].'" id="postalcode">
    <span class="error"> '.$formInputs['postalcodeErr'].'</span>
  </div>
  <div>
    <label for="city">Woonplaats:</label> 
    <input type="text" name="city" value="' .$formInputs['city'].'" id="city">
    <span class="error">'.$formInputs['cityErr'].'</span>
  </div>

    <!-- Voorkeur communication -->
  <div>
  <label for="city">Hoe wilt u communiceren?</label> 
  </div>
  <fieldset class = "communication">
     <!-- Need some help here: the legend brings a nice shape to things, but due to how the title in it works it isnt a perfect square -->
     <legend class = "communication"><span class="error">*'.$formInputs['communcationErr'].'</span></legend> 
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
    <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$formInputs['message'].'" ></textarea>
    <span class="error">* '.$formInputs['messageErr'].'</span>
  </div>
  <div>
    <!-- <label class = "hidden" for="submit"> hidden </label> -->
    <input class="submit" type="submit" value="Submit">
  </div>
    </fieldset>
  </form> 
  ';
}

function postDataContact(){
  $formInputs['title'] = getPostVar("title");
  $formInputs['name'] = getPostVar("name");
  $formInputs['email'] = getPostVar("email");
  $formInputs['phonenumber'] = getPostVar("phonenumber");
  $formInputs['street'] = getPostVar("street");
  $formInputs['housenumber'] = getPostVar("housenumber");
  $formInputs['postalcode'] = getPostVar("postalcode");
  $formInputs['city'] = getPostVar("city");
  $formInputs['communication'] = getPostVar("communication");
  $formInputs['message'] = getPostVar("message");
  var_dump($formInputs);
  return $formInputs;
}

function formCheckContact($formInputs) {
  // Order of arrays should be: title, name, email, phonenumber, street, housenumber, postalcode, city, communication, message
  $errors = array('titleErr' => '', 'nameErr' => '', 'emailErr' => '', 'phonenumberErr' => '', 'streetErr' => '', 
                  'housenumberErr' => '', 'postalcodeErr' => '', 'cityErr' => '', 'communicationErr' => '', 'messageErr' => '');
  $valid = false;
  $postRequired = false;
	//Ordered the same way the form is in
  // so this is the title
  $errors['titleErr'] = checkFieldContent($formInputs['title'], $errors['titleErr']);
  // the name
  $errors['nameErr'] = checkFieldContent($formInputs['name'], $errors['nameErr']);
  // the message
  $errors['messageErr'] = checkFieldContent($formInputs['message'], $errors['messageErr']);
  // the communication method
  $errors['communcationErr'] = checkFieldContent($formInputs['communication'], $errors['communicationErr']);
  
  if ($formInputs['communcation'] == "email") {
    $errors['emailErr'] = checkFieldContent($formInputs['email'], $errors['emailErr']);
  } elseif ($formInputs['communcation'] == "phone") {
    $errors['phonenumberErr'] = checkFieldContent($formInputs['phonenumberErr'], $errors['phonenumberErr']);
  } elseif ($formInputs['communication'] == "post"){
    $postRequired = true;
  }
  
  $postData = array($formInputs['street'], $formInputs['housenumber'], $formInputs['postalcode'], $formInputs['city']);
  foreach ($postData as $x) {
    if ($x != '') {
      $postRequired = true;
    }
  }
    
  if ($postRequired) {
    //Validating postal code
    $errors['postalcodeErr'] = checkPostalCode($formInputs['postalcode']);
    //in order street, housenumber, postalcode, city
    $errors['streetErr'] = checkFieldContent($formInputs['street']);
    $errors['housenumberErr'] = checkFieldContent($formInputs['housenumber']);
    $errors['postalcodeErr'] = checkFieldContent($formInputs['postalcode']);
    $errors['cityErr'] = checkFIeldContent($formInputs['city']);

  }
  // have to check if the email is actually an email if its filled
  if (empty($formInputs['email'] == false)){ 
    $errors['emailErr'] = checkEmail($formInputs['email']);
  }
  
  //Validity check, first check if everything is the same, if it is, check if $errors[1] is empty because it means there's no errors
  // actually might not be necessary to check nameErr, because under no circumstances are all fields required
  $valid = (count(array_unique($errors, SORT_REGULAR)) == 1);
  if ($valid == 'true' && $errors['name'] == ''){
    // the thanks is the page to redirect to, the error messages are unneeded since the input is valid
    return array('page' =>'thanks');
  } 
  // otherwise it should circle back with data to fill the og page, which means including the page name to link back to
  $errors['page'] = 'contact';
  return $errors;
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
