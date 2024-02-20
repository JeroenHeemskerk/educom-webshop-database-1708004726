<?php
function showHeadWebshop(){
  echo '<title> Shop page </title>';
}

function showHeaderWebshop(){
  echo '<header class=title><h1> Shop </h1></header>';
}

function showContentWebshop(){
  $items = getItemsFromDB('id, name, price, image');
if (!$items){
  echo 'Database niet beschikbaar';
} else {
  echo '<ul class=items>';
  foreach ($items as $x) {
    echo '
    <li class=product_webshop>
    <br>
      <article>
      <a class=product_image  href="index.php?page=product-'.$x[1].'-'.$x[0].'"> 
      <img src="images\\'.$x[3].'"  style="width:128px;height:128px;"> 
      </a>
      <h3 class=product_name>
      <a class=product_text href="index.php?page=product-'.$x[1].'-'.$x[0].'">
        <span>'.$x[1].' </span>
      </a>
      </h3>
      <div class=product_price>
        <span class=price>'.$x[2].' euro </span>
      </div>';
      // show button for adding to shopping cart
      if (isset($_SESSION['userName'])){
        echo '
        <button onclick="addToCart('.$x[0].')">Toevoegen aan bestelling</button>';
      }
      
      echo '</article>
      </li>';
    }
  echo '</ul>';
  } 

}
  

?>
