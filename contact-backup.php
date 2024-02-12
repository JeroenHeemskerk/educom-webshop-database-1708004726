<!DOCTYPE html>
<html lang="nl">
<head>
  <title>Contact form</title>
  <link rel="stylesheet" href="CSS/mystyle.css">
</head>
<body class="algemeen">
<?php

$title = $name = $message = $email = $phonenumber = $street = $housenumber = $postalcode = $city = $communication = '';
$titleErr = $nameErr = $messageErr = $emailErr = $phoneErr = $streetErr = $housenumberErr = $postalcodeErr = $cityErr = $communicationErr = '';
$valid = false;
$postRequired = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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


?>

<header  class=title><h1>De contact pagina van Milan Lucas</h1></header>

<nav>
<ul class="menu">
 <li><a href="index.html">Home</a></li> 
 <li><a href="about.html">About</a></li> 
 <li><a href="contact.php">Contact</a></li> 
</ul> 
</nav>

<?php if (!$valid) { /* Show the next part only when $valid is false */ ?>

<form class="contact" method="POST" action="contact.php"">
<fieldset class="persoon">
<div>
<label for="title">title:</label> 
<select id="title" name="title">
  <option value=""></option>
  <option value="sir" <?php if (isset($title) && $title == "sir") echo "selected" ?>>Dhr.</option> 
  <option value="madam" <?php if (isset($title) && $title == "madam") echo "selected" ?> >Mvr.</option>
  <option value="other" <?php if (isset($title) && $title == "other") echo "selected" ?>>Anders</option>
</select> 
  <span class="error">* <?php echo $titleErr; ?></span>
</div>
<div>
  <label for="name"> Naam:</label> 
	<input type="text" name="name" value="<?php echo $name; ?>" id="name">
	<span class="error">* <?php echo $nameErr; ?></span>
</div>
<div>
  <label for="email">E-mail:</label> 
    <input type="text" name="email" value="<?php echo $email; ?>" id="email">
	<span class="error"> <?php echo $emailErr; ?></span>
</div>
<div>
  <label for="phonenumber">Telefoon nummer:</label> 
	<input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>" id="phonenumber">
	<span class="error"> <?php echo $phoneErr; ?></span>
</div>
<div>
  <label for="street">Straat:</label> 
	<input type="text" name="street" value="<?php echo $street; ?>" id="street">
	<span class="error"> <?php echo $streetErr; ?></span>
</div>
<div>
  <label for="housenumber">Huisnummer:</label> 
	<input type="text" name="housenumber" value="<?php echo $housenumber; ?>" id="housenumber">
	<span class="error"> <?php echo $housenumberErr; ?></span>
</div>
<div>
  <label for="postalcode">Postcode:</label> 
	<input type="text" name="postalcode" value="<?php echo $postalcode; ?>" id="postalcode">
	<span class="error"> <?php echo $postalcodeErr; ?></span>
</div>
<div>
  <label for="city">Woonplaats:</label> 
	<input type="text" name="city" value="<?php echo $city; ?>" id="city">
	<span class="error"> <?php echo $cityErr; ?></span>
</div>

	<!-- Voorkeur communication -->


  <!-- this check is a wip -->
<fieldset class = "communication">
   <legend>Hoe wilt u communiceren?</legend> 
    <span class="error">* <?php echo $communicationErr; ?></span>
    <div>
    <input type="radio" name="communication" value="email" <?php echo ($communication=="email" ? 'checked="checked"' : '') ?>>
    <label for="email">Email</label> 
    </div>
    <div>
    <input type="radio" name="communication" value="phone" <?php echo ($communication=="phone" ? 'checked="checked"' : '') ?>>
    <label for="phone">Telefoon</label> 
    </div>
    <div>
    <input type="radio" name="communication" value="post" <?php echo ($communication=="post" ? 'checked="checked"' : '') ?>> 
   
    <label for="post">Post</label>
    </div>
     
   </legend>
  </fieldset>

	<!-- reden van contact -->
<div>
  <label for="message">Waarom wilt u contact opnemen?</label>
	<textarea id="message" name="message" rows="4" cols="50" placeholder="<?php echo $message; ?>" ></textarea>
	<span class="error">* <?php echo $messageErr; ?></span>
</div>
<div>
  <label class = "hidden" for="submit"> hidden </label>
  <input type="submit" value="Submit">
</div>
  </fieldset>
</form> 

<?php } else { /* Show the next part only when $valid is true */ ?>
   <p>Bedankt voor uw reactie:</p> 
   
   <div>Naam: <?php echo $name; ?></div>
   <div>Email: <?php echo $email; ?></div>
   <div>Telefoon: <?php echo $phonenumber; ?></div>
   <div>Straat: <?php echo $street; ?></div>
   <div>Huisnummer: <?php echo $housenumber; ?></div>
   <div>Postcode: <?php echo $postalcode; ?></div>
   <div>Woonplaats: <?php echo $city ?></div>
   <div>Communicatie voorkeur: <?php echo $communication ?></div>
 <?php } /* End of conditional showing */ ?>

<footer> &#169; - 2024 - Milan Lucas
</footer> 
</body>
</html> 


