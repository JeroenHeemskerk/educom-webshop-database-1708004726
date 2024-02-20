<?php
session_start();

function doLoginUser($name, $email){
  $_SESSION['userName'] = $name;
  $_SESSION['email'] = $email;
  makeCart();

}

function makeCart(){
  $idList = getItemsFromDB('id');
  $_SESSION['basket'] = array('00'=> 0);
  foreach ($idList as $x) {
    $key = '0'.$x[0];
    $_SESSION['basket'][$key] = 0;
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

function addItemToBasket($id){
  $key = '0'.$id;
  $count = $_SESSION['basket'][$key] + 1;
  $_SESSION['basket'][$key] = $count;
}


?>