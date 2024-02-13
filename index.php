<?php
$page = getRequestedPage(); 
if ($_SERVER['REQUEST_METHOD'] == "POST") {
processRequest();
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

function processRequest(){
  switch($_POST['page']){
    case 'contact';
      var_dump($_POST);
      echo 'contact';
    case 'register';
      var_dump($_POST);
      echo 'register';
    case 'login';
      var_dump($_POST);
      echo 'login';
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
  echo '<head>';
  
  switch ($page) { 
    case 'home':
      require('home.php');
        showHeadHome();
        break;
    case 'about':
      require('about.php');
        showHeadAbout();
        break;
    case 'contact':
      require('contact.php');
        showHeadContact();
        break;
    case 'register':
        require('register.php');
          showHeadRegister();
          break;
    case 'login':
        require('login.php');
          showHeadLogin();
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
  switch ($page) { 
    case 'home':
        showHeaderHome();
        break;
    case 'about':
        showHeaderAbout();
        break;
    case 'contact':
        showHeaderContact();
        break;   
    case 'register':
        showHeaderRegister();
        break;  
    case 'login':
        showHeaderLogin();
        break;         
   }
}

function showMenu(){
  echo '<ul class="menu">
  <li><a href="index.php?page=home">Home</a></li> 
  <li><a href="index.php?page=about">About</a></li> 
  <li><a href="index.php?page=contact">Contact</a></li> ';
  
  // testing flag for menu display
  $logged_in = false;
  if ($logged_in == false){
    echo '<li><a href="index.php?page=register">Register</a></li> 
    <li><a href="index.php?page=login">Login</a></li> ';
  } else {
    echo '<li><a href="index.php?page=logout">Logout</a></li> ';
  echo '</ul>';
}
}

function showContent($page){

  switch ($page) { 
    case 'home':
        showContentHome();
        break;
    case 'about':
        showContentAbout();
        break;
    case 'contact':
        showContentContact();
        break;    
    case 'register':
        showContentRegister();
        break;           
    case 'login':
        showContentLogin();
        break;               
   }
}

function showFooter(){
  echo '<footer> 
  &#169; - 2024 - Milan Lucas
  </footer> ';
}

?>