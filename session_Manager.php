<?php
session_start();

function doLoginUser($name){
  $_SESSION['userName'] = $name;
}


?>