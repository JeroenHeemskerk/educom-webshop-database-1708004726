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
//var_dump($page);
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
  switch($page){
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
    case 'password':
      // can't use associative all the way because the OG get array is index
      $formInputs = postDataPassword();
      $errors = formCheckPasswords($formInputs);
      return $errors;
    case 'logout':
      doLogout();
      $data['page'] = 'home';
    case 'cart':
      handleActions();
  }
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
      case strstr(end($page), 'product'):
        showHeadDetail(end($page));
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
  showMenu(); 
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

function showMenu(){
  echo '<ul class="menu">';
  showMenuItem('home', 'Home');
  showMenuItem('about', 'Over mij');
  showMenuItem('contact', 'Contact');
  showMenuItem('webshop', 'Shop');

  // check if session is set
  if (!isset($_SESSION['userName'])){
    showMenuItem('register', 'Registeren');
    showMenuItem('login', 'Login');
  } else {
    showMenuItem('cart', 'Winkelwagen');
    showMenuItem('password', 'wachtwoord');
    $logout = 'Uitloggen '.getSessionUser();
    showMenuItem('logout', $logout);
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