
<?php
function showHeadContact(){
  echo '<title>Contact form</title>';
}

function showHeaderContact(){
  echo '<header  class=title><h1>De contact pagina van Milan Lucas</h1></header>';
}

function showContentContact(){
  $requestedType = $_SERVER['REQUEST_METHOD']; 
  if ($requestedType == "GET") {
   contactForm();
  } else { 
  echo "check";
  
  }

}

function contactForm() {
  $title = $name = $message = $email = $phonenumber = $street = $housenumber = $postalcode = $city = $communication = '';
  $title = 'sir';
  $titleErr = $nameErr = $messageErr = $emailErr = $phoneErr = $streetErr = $housenumberErr = $postalcodeErr = $cityErr = $communicationErr = '';
  echo '<form class="contact" method="POST" action="index.php?page=contact.php">
  <fieldset class="persoon">
  <div>
  <label for="title">title:</label> 
  <select id="title" name="title">
    <option value=""></option>
    <option value="sir" >Dhr.</option> <!-- used to be before >Dhr <?php if (isset($title) && $title == "sir") echo "selected" ?> -->
    <option value="madam"  >Mvr.</option>
    <option value="other" >Anders</option>
  </select> 
    <span class="error">* <?php echo $titleErr; ?></span>
  </div>
  <div>
    <label for="name"> Naam:</label> 
    <input type="text" name="name" value="'.$name.'" id="name">
    <span class="error">* '.$nameErr.'</span>
  </div>
  <div>
    <label for="email">E-mail:</label> 
      <input type="text" name="email" value="'.$email.'" id="email">
    <span class="error"> '.$emailErr.'</span>
  </div>
  <div>
    <label for="phonenumber">Telefoon nummer:</label> 
    <input type="text" name="phonenumber" value="'.$phonenumber.' " id="phonenumber">
    <span class="error"> '.$phoneErr.'</span>
  </div>
  <div>
    <label for="street">Straat:</label> 
    <input type="text" name="street" value="'.$street.'" id="street">
    <span class="error"> '.$streetErr.'</span>
  </div>
  <div>
    <label for="housenumber">Huisnummer:</label> 
    <input type="text" name="housenumber" value="' .$housenumber.'" id="housenumber">
    <span class="error"> '.$housenumberErr.'</span>
  </div>
  <div>
    <label for="postalcode">Postcode:</label> 
    <input type="text" name="postalcode" value="'.$postalcode.'" id="postalcode">
    <span class="error"> '.$postalcodeErr.'</span>
  </div>
  <div>
    <label for="city">Woonplaats:</label> 
    <input type="text" name="city" value="' .$city.'" id="city">
    <span class="error">'.$cityErr.'</span>
  </div>

    <!-- Voorkeur communication -->
    <!-- Zit vast op het omzetten van de checked statement --> 
  <fieldset class = "communication">
     <legend>Hoe wilt u communiceren?</legend> 
      <span class="error">* '.$communicationErr.'</span>
      <div>
      <input type="radio" name="communication" value="email"   >  <!-- <?php echo ($communication=="email" ? \'checked="checked"\' : \'\') ?> was originally in the now empty space -->
      <label for="email">Email</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="phone"   >
      <label for="phone">Telefoon</label> 
      </div>
      <div>
      <input type="radio" name="communication" value="post"   > 
     
      <label for="post">Post</label>
      </div>
       
     </legend>
    </fieldset>

    <!-- reden van contact -->
  <div>
    <label for="message">Waarom wilt u contact opnemen?</label>
    <textarea id="message" name="message" rows="4" cols="50" placeholder="'.$message.'" ></textarea>
    <span class="error">* '.$messageErr.'</span>
  </div>
  <div>
    <label class = "hidden" for="submit"> hidden </label>
    <input type="submit" value="Submit">
  </div>
    </fieldset>
  </form> 
  ';
}

function formCheck() {
  $valid = false;
  $postRequired = false;
  
	//Ordered by whether or not the variablei is necessary input
	// title, name, message and communication are always necessary
  $title = $_POST["title"];
  $name = $_POST["name"];
  $message = $_POST["message"];
  $communication = $_POST["communication"];
  $email = $_POST["email"];
  $phonenumber = $_POST["phonenumber"];
  $street = $_POST["street"];
  $housenumber = $_POST["housenumber"];
  $postalcode = $_POST["postalcode"];
  $city = $_POST["city"];
  
  $titleErr = dataPresent($title, $titleErr);
  $nameErr = dataPresent($name, $nameErr);
  $messageErr = dataPresent($message, $messageErr);
  $communicationErr = dataPresent($communication, $communicationErr);
  
  
  if ($communication == "email") {
    $emailErr = dataPresent($email, $emailErr);
  } elseif ($communication == "phone") {
    $phoneErr = dataPresent($phone, $phoneErr);
  } elseif ($communication == "post"){
    $postRequired = true;
  }
  
  $postData = array($street, $housenumber, $postalcode, $city);
  foreach ($postData as $x) {
    if ($x != '') {
      $postRequired = true;
    }
  }
    
  if ($postRequired) {
    //Validating postal code
    $postRegex = "/^[0-9]{4}\s[A-z]{2}$/";
    if (!preg_match($postRegex, $postalcode)) { 
      $postalcodeErr = "Dit is niet een nederlandse postcode";
    }
    
    $streetErr = dataPresent($street, $streetErr);
    $housenumberErr = dataPresent($housenumber, $housenumberErr);
    $postalcodeErr = dataPresent($postalcode, $postalcodeErr);
    $cityErr = dataPresent($city, $cityErr);
    
  }
  //Validity check, first check if everything is the same, if it is, check if nameErr is empty because it means there's no errors
  $errorList = array($titleErr, $nameErr, $messageErr, $emailErr, $phoneErr, $streetErr, $housenumberErr, $postalcodeErr, $cityErr, $communicationErr);
  $valid = (count(array_unique($errorList, SORT_REGULAR)) == 1);
  
}

function dataPresent($data, $err) {
  if (empty($data)) $err = "Dit veld moet nog ingevuld worden"; 
  return $err;
}





