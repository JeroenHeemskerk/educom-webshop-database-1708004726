<?php
session_start();

function doLoginUser($name, $email){
  $_SESSION['userName'] = $name;
  $_SESSION['email'] = $email;
  makeCart();
}

function makeCart(){
  $idList = getItemsFromDB('id');
  $_SESSION['basket'] = array('0'=> 0);
  foreach ($idList as $x) {
    $_SESSION['basket'][$x[0]] = 0;
  }
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

function AddToCart($id){
  var_dump($id);
}


?>