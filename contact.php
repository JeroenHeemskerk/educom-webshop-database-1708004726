
<?php
function showHeadContact(){
  echo '<title>Contact form</title>';
}

function showHeaderContact(){
  echo '<header  class=title><h1>Contact</h1></header>';
}

function showContentContact($formInputs){
  // order of arrays is title, name, email, phonenumber, street, housenumber, postalcode, city, message, communication (repeating once after communication)
  $title = $formInputs['title'];
  $communication = $formInputs['communication'];

  echo '<form class="contact" method="POST" action="index.php">
  <input type="hidden" name="page" value="contact" id="page"/>
  <fieldset class="persoon">
  <div>
  <label for="title">title:</label> 
  <select id="title" name="title">
    <option value=""></option>
    <option value="sir" '.($title == "sir"   ? "selected" : "").' >Dhr.</option> 
    <option value="madam" '.($title == "madam"   ? "selected" : "").' >Mvr.</option>
    <option value="other" '.($title == "other"   ? "selected" : "").'>Anders</option>
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
      <input type="radio" name="communication" value="email" '.($communication == "email"   ? "checked" : "").' >  
      <label for="email">Email</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="phone"  '.($communication == "phone"   ? "checked" : "").' >
      <label for="phone">Telefoon</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="post"  '.($communication == "post"   ? "checked" : "").' > 
     
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
  if ($valid == 'true' && $errors['nameErrrepeatErr'] == ''){
    // the thanks is the page to redirect to, the error messages are unneeded since the input is valid
    return array('page' =>'thanks');
  } 
  // otherwise it should circle back with data to fill the og page, which means including the page name to link back to
  $errors['page'] = 'contact';
  return $errors;
}



function showContentThanks($formInputs){
  // changing phone to telefoon for the display 
  if ($formInputs['communication'] == 'phone'){
    $formInputs['communication'] = 'telefoon';
  }
 
  echo '<p>Bedankt voor uw reactie:</p> 
  <div>Naam: '.$formInputs['name'].'</div>
  <div>Email: '.$formInputs['email'].'</div>
  <div>Telefoon: '.$formInputs['phonenumber'].'</div>
  <div>Straat: '.$formInputs['street'].'</div>
  <div>Huisnummer: '.$formInputs['housenumber'].'</div>
  <div>Postcode: '.$formInputs['postalcode'].'</div>
  <div>Woonplaats: '.$formInputs['city'].'</div>
  <div>Communicatie voorkeur: '.$formInputs['communication'].'</div>';
}

?>
