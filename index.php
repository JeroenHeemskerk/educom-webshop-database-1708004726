<?php
//load in required external functions
require('session_Manager.php');
require('home.php');
require('about.php');
require('contact.php');
require('register.php');
require('login.php');
require('password.php');
require('webshop.php');
require('detail.php');
require('cart.php');
require('validate.php');
require('user_Service.php');
require('db_Repository.php');

$page = getRequestedPage(); 
//if ($_SERVER['REQUEST_METHOD'] == "POST") {
$page = processRequest($page);
//}

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
  //$requestedPage = array_merge( array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''), array($requestedPage));
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
  $data = array('page' => $page);
  echo '<br>';
  switch($page){
    case 'contact':
      // first step is retrieving the input data, I want to retrieve inputs only once
      $formInputs = postDataContact();
      // next we have to check if there are any error messages
      $errors = formCheckContact($formInputs);
      // finally appending them together to create a page reference with all the data required to fill said page (on POST)
      $formInputs = array_merge($formInputs, $errors);
      // then make it part of the data
      $data = array_merge($formInputs, $data);
      $data['page'] = 'contact';
      break;
    case 'register':
      $formInputs = postDataRegister();
      $errors = formCheckRegister($formInputs);
      $formInputs = array_merge($formInputs, $errors);
      $data = array_merge($formInputs, $data);
      break;
    case 'login':
      $formInputs = postDataLogin();
      $errors = formCheckLogin($formInputs);
      $formInputs = array_merge($formInputs, $errors);
      $data = array_merge($formInputs, $data);
      break;
    case 'password':
      $formInputs = postDataPassword();
      $errors = formCheckPasswords($formInputs);
      $data = array_merge($errors, $data);
      break;
    case 'logout':
      doLogout();
      $data['page'] = 'home';
      var_dump($data['page']);
      break;
    case 'cart':
      handleActions();
      break;
  }
  // no matter the page, some data is always necessary: the menu
  $data = menuItems($data);
  return $data;
}

function handleActions(){
  $action = getPostVar("action");
  switch($action) {
    case "addToCart":
      $id = getPostVar("id");
      addItemToBasket($id);
      break;
    case "placeOrder";
      placeOrderDB();
    break;
  }
} 

function menuItems($data){
  $data['menu'] = array('home' => 'Home', 'about' => 'Over mij', 'contact' => 'Contact', 'webshop' => 'WEBSHOP');
  if (isUserLoggedIn()) {
    $data['menu']['cart'] = "Winkelwagen";
    $data['menu']['password'] = "Wachtwoord";
    $data['menu']['logout'] = "Uitloggen " . getSessionUser(); 
  } else {
    $data['menu']['register'] = "Registreren";
    $data['menu']['login'] = 'Inloggen';
  }
  return $data;
}

function logErrors($msg){
  echo "LOG TO SERVER:".$msg;
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
  switch($page['page']){
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

    case 'password':
        showHeadPassword();
        break;
      case 'webshop':
        showHeadWebshop();
        break;
      case strstr($page['page'], 'product'):
        showHeadDetail($page['page']);
        break;
      case 'cart':
        showHeadCart();
        break;
   }
   
   echo '<link rel="stylesheet" href="CSS/mystyle.css">
    </head>';
}

function showBodySection($page) { 
  echo '<body class="algemeen">' . PHP_EOL; 
  showHeader($page);
  showMenu($page); 
  showContent($page); 
  showFooter(); 
  echo '</body>' . PHP_EOL; 
} 

function showDocumentEnd(){
  echo '</html>'; 
}
function showHeader($page){
  switch($page['page']){
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
    case 'password':
        showHeaderPassword();
        break;
      case 'webshop':
        showHeaderWebshop();
        break;
      case strstr($page['page'], 'product'):
        showHeaderDetail($page['page']);
        break;
      case 'cart':
        showHeaderCart();
        break;          
   }
}

function showMenu($page){
  echo '<ul class="menu">';
  foreach($page['menu'] as $link => $label) { 
    showMenuItem($link, $label); 
  } 
  echo '</ul>';
}

function showMenuItem($page, $pageName){
  echo '<li><a href="index.php?page='.$page.'">'.$pageName.'</a></li>';
}

function showContent($page){
  switch($page['page']){
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
    case 'password':
        showContentPassword($page);
        break;
      case 'webshop':
        showContentWebshop();
        break;
      case strstr(end($page), 'product'):
        showContentDetail(end($page));
        break;
      case 'cart':
        showContentCart();
        break;           
   }
}

function showFooter(){
  echo '<footer> 
  &#169; - 2024 - Milan Lucas
  </footer> ';
}

?>