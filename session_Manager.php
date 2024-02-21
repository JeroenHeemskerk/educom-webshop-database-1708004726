<?php
session_start();

function doLoginUser($name, $email){
  $_SESSION['userName'] = $name;
  $_SESSION['email'] = $email;
  makeCart();

}

function makeCart(){
  $_SESSION['basket'] = array();
}

function isUserLoggedIn(){
  $loggedIn = false;
  if(isset($_SESSION['userName'])){
    $loggedIn = true;
  }
  return $loggedIn;
}

function getSessionUser(){
  return $_SESSION['userName'];
}

function getSessionEmail(){
  return $_SESSION['email'];
}

function doLogout(){
  session_unset();
}

function getSessionBasket(){
  return $_SESSION['basket'];
}

function addItemToBasket($id){
  if (array_key_exist($id, $_SESSION['basket'])) {
    $_SESSION['basket'][$id] += 1;
  } else { 
    $_SESSION['basket'][$id] = 1;
  } 
} 


?>