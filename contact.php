<!DOCTYPE html>
<html lang="nl">
<head>
  <title>Simpele HTML</title>
  <link rel="stylesheet" href="CSS/mystyle.css">
</head>
<body class="algemeen">
<?php

$title = $name = $message = $email = $phonenumber = $street = $housenumber = $postalcode = $city = $communication = '';
$titleErr = $nameErr = $messageErr = $emailErr = $phoneErr = $streetErr = $housenumberErr = $postalcodeErr = $cityErr = $communicationErr = '';
$valid = false;

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
  $communicationErr = datapresent($communication, $communicationErr);
}

function dataPresent($data, $err) {
  if (empty($data)) $err = "Dit moet nog ingevuld worden"; //true
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
<p class="persoon">
<label for="title">title:</label><br>
<select id="title" name="title">
  <option value="dhr">Dhr.</option>
  <option value="mvr">Mvr.</option>
  <option value="anders">Anders</option>
</select> 
  <span class="error">* <?php echo $titleErr; ?></span>
<br>
  <label for="name"> name:</label><br>
	<input type="text" name="name" value="<?php echo $name; ?>" id="name">
	<span class="error">* <?php echo $nameErr; ?></span>
  <label for="email">E-mail:</label><br>
    <input type="text" name="email" value="<?php echo $email; ?>" id="email">
	<span class="error"> <?php echo $emailErr; ?></span>
  <label for="phonenumber">phone nummer:</label><br>
	<input type="text" name="phonenumber" value="<?php echo $phonenumber; ?>" id="phonenumber">
	<span class="error"> <?php echo $phoneErr; ?></span>
  <label for="street">street:</label><br>
	<input type="text" name="street" value="<?php echo $street; ?>" id="street">
	<span class="error"> <?php echo $streetErr; ?></span>
  <label for="housenumber">housenumber:</label><br>
	<input type="text" name="housenumber" value="<?php echo $housenumber; ?>" id="housenumber">
	<span class="error"> <?php echo $housenumberErr; ?></span>
  <label for="postalcode">postalcode:</label><br>
	<input type="text" name="postalcode" value="<?php echo $postalcode; ?>" id="postalcode">
	<span class="error"> <?php echo $postalcodeErr; ?></span>
  <label for="city">city:</label><br>
	<input type="text" name="city" value="<?php echo $city; ?>" id="city">
	<span class="error"> <?php echo $cityErr; ?></span
</p>
	<!-- Voorkeur communication -->
<p> Via welke methode kan ik u het best bereiken?</p>

<p class = "bereik">
  <!-- this check is a wip -->
  <input type="radio" name="communication" value="email" checked="<?php if ($communication = "email") ?>" >
  <label for="email">Email</label><br>
  <input type="radio" name="communication" value="phone">
  <label for="phone">phone</label><br>
  <input type="radio" name="communication" value="post">
  <label for="post">Post</label>
  <span class="error">* <?php echo $communicationErr; ?></span>
  <br>


<p class = "contact>
	<!-- reden van contact -->
  <label for="message">Waarom wilt u contact opnemen?</label>
  <br>
	<textarea id="message" name="message" rows="4" cols="50" placeholder="<?php echo $message; ?>" ></textarea>
	<span class="error">* <?php echo $messageErr; ?></span>
  <br>
  <input type="submit" value="Submit">
  
</form> 

<?php } else { /* Show the next part only when $valid is true */ ?>

 <?php } /* End of conditional showing */ ?>

<footer> &#169; - 2024 - Milan Lucas
</footer> 
</body>
</html> 


