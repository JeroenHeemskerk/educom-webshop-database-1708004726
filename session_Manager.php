<?php
session_start();

function doLoginUser($name){
  $_SESSION['userName'] = $name;
}

function doLogout(){
  session_unset();
}


?>