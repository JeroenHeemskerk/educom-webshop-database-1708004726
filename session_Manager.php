<?php
session_start();

function doLoginUser($name, $email){
  $_SESSION['userName'] = $name;
  $_SESSION['email'] = $email;
}

function getSessionUser(){
  return $_SESSION['userName'];
}

function doLogout(){
  session_unset();
}


?>