<?php
session_start();
$_SESSION["loggedIn"] = false;
$_SESSION["userName"] = ''; 
//load in required external functions
require('home.php');
require('about.php');
require('contact.php');
require('register.php');
require('login.php');

$page = getRequestedPage(); 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$page = processRequest($page);
}
showResponsePage($page); 

function getRequestedPage() {
  $requestedType = $_SERVER['REQUEST_METHOD']; 
  if ($requestedType == "POST") {
    $requestedPage = getPostVar('page', 'home');
  } else {
    // Here I need to get the actually requested page and not have it fill in just page
    $requestedPage = getGetVar('page','home');
  }
  // Note that contact, register, and login need a longer array to function (they fill in inputs from the array
  // so we have to include a long blank array to use
  $requestedPage = array_merge( array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), array($requestedPage));
  return $requestedPage;
}
  
function getArrayVal($array, $key, $default='') {
   return isset($array[$key]) ? $array[$key] : $default; 
} 

function getPostVar($key, $default='') {
  return getArrayVal($_POST, $key, $default);  
}

function getGetVar($key, $default=''){
  return getArrayVal($_GET, $key, $default);
}

function processRequest($page){
  //The process depends on which page is submitted
  switch(end($page)){
    case 'contact':
      // first step is retrieving the input data, I want to retrieve inputs only once
      $formInputs = postDataContact();
      // next we have to check if there are any error messages
      $errors = formCheckContact($formInputs);
      // finally appending them together to create a page reference with all the data required to fill said page (on POST)
      $formInputs = array_merge($formInputs, $errors);
      return $formInputs;
    case 'register':
      $formInputs = postDataRegister();
      $errors = formCheckRegister($formInputs);
      $formInputs = array_merge($formInputs, $errors);
      // so I need to make a small tweak here because this can redirect to login
      // and in that case it becomes a thing that it takes along all the inputs to the login page
      if (end($errors) == 'login'){
        $formInputs = array('', '', '', '', 'login');
      }
      return $formInputs;
    case 'login':
      $formInputs = postDataLogin();
      $errors = formCheckLogin($formInputs);
      $formInputs = array_merge($formInputs, $errors);
      return $formInputs;
  }
}

function checkEmail($email){
  $error = '';
  if (filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = '';
  } else {
   $error = 'Dit is geen geldig email address';
  }
  return $error;
}

function showResponsePage($page) {
  showDocumentStart(); 
  showHeadSection($page); 
  showBodySection($page); 
  showDocumentEnd(); 
}     

function showDocumentStart() { 
  echo '<!doctype html> 
  <html>'; 
} 

function showHeadSection($page){
  // only the title differs between these head sections so, you can load/close the head and reference the css here
  echo '<head>';
  switch(end($page)){
    case 'home':
        showHeadHome();
        break;
    case 'about':
        showHeadAbout();
        break;
    case 'contact': 
        showHeadContact();
        break;
    case 'thanks': 
        showHeadContact();
        break;
    case 'register':
          showHeadRegister();
          break;
    case 'login': 
          showHeadLogin();
          break;    
    case 'logout':        
          showHeadHome();
          // resetting the session 
          session_unset(); 
          $_SESSION["loggedIn"] = false;
          $_SESSION["userName"] = ''; 
          break;            
   }
   
   echo '<link rel="stylesheet" href="CSS/mystyle.css">
    </head>';
}

function showBodySection($page) { 
  echo '<body class="algemeen">' . PHP_EOL; 
  showHeader($page);
  showMenu(); 
  showContent($page); 
  showFooter(); 
  echo '</body>' . PHP_EOL; 
} 

function showDocumentEnd(){
  echo '</html>'; 
}
function showHeader($page){
  switch(end($page)){
    case 'home':
        showHeaderHome();
        break;
    case 'about':
        showHeaderAbout();
        break;
    case 'contact':
        showHeaderContact();
        break;   
    case 'thanks':
        showHeaderContact();
        break; 
    case 'register':
        showHeaderRegister();
        break;  
    case 'login':
        showHeaderLogin();
        break;   
    case 'logout':        
          showHeaderHome();
          break;           
   }
}

function showMenu(){
  echo '<ul class="menu">
  <li><a href="index.php?page=home">Home</a></li> 
  <li><a href="index.php?page=about">About</a></li> 
  <li><a href="index.php?page=contact">Contact</a></li> ';
  if ($_SESSION['loggedIn'] == false){
    echo '<li><a href="index.php?page=register">Register</a></li> 
    <li><a href="index.php?page=login">Login</a></li> ';
  } else {
    echo '<li><a href="index.php?page=logout">Logout '.$_SESSION["userName"].'</a></li> ';
  echo '</ul>';
}
}

function showContent($page){
  switch(end($page)){
    case 'home':
        showContentHome();
        break;
    case 'about':
        showContentAbout();
        break;
    case 'contact':
        showContentContact($page);
        break;    
    case 'thanks':
        showContentThanks($page);
        break; 
    case 'register':
        showContentRegister($page);
        break;           
    case 'login':
        showContentLogin($page);
        break;       
    case 'logout':        
          showContentHome();
          break;           
   }
}

function showFooter(){
  echo '<footer> 
  &#169; - 2024 - Milan Lucas
  </footer> ';
}

?>