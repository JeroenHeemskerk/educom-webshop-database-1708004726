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
        <a class=product_image  href="index.php?page=product-'.$x['name'].'-'.$x['id'].'"> 
        <img src="images\\'.$x['image'].'"  style="width:128px;height:128px;"> 
        </a>
        <h3 class=product_name>
        <a class=product_text href="index.php?page=product-'.$x['name'].'-'.$x['id'].'">
          <span>'.$x['name'].' </span>
        </a>
        </h3>
        <div class=product_price>
          <span class=price>'.$x['price'].' euro </span>
        </div>';
        // show button for adding to shopping cart
        if (isset($_SESSION['userName'])){
          echo '
          <form action="index.php" method="POST">
          <input type="hidden" name="page"value="webshop">
          <input type="hidden" name="action" value="addToCart">
          <input type="hidden" name="id" value="'.$x['id'].'">
          <button type="submit">Toevoegen aan bestelling</button>
          </form>';
        }
        echo '</article>
        </li>';
      }
    echo '</ul>';
  } 
}


?>
