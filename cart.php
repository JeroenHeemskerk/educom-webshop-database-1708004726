<?php
function showHeadCart(){
  echo '<title> Cart page </title>';
}

function showHeaderCart(){
  echo '<header class=title><h1> Winkelwagen </h1></header>';
}

function showContentCart(){
  //getItemsFromDB();
  echo 'WIP';
}


function addToCartButton($page, $id){
  if (isset($_SESSION['userName'])){
    echo '
    <form action="index.php?page='.$page.'" method="POST">
    <input type="hidden" name="page"value="webshop">
    <input type="hidden" name="action" value="addToCart">
    <input type="hidden" name="id" value="'.$id.'">
    <button type="submit">Toevoegen aan bestelling</button>
    </form>';
  }
}


?>