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
}

  echo '<ul class=items>';
  foreach ($items as $x) {
    echo '
    <li class=product_webshop>
    <br>
      <article>
      <a class=product_image  href="index.php?page=detail"> 
      <img src="images\\'.$x[3].'"  style="width:128px;height:128px;"> 
      </a>
      <h3 class=product_name>
      <a class=product_text href="index.php?page=detail">
        <span>'.$x[1].' 
      </a>
      </h3>
      <div class=product_price>
        <span>'.$x[2].' euro </span>
      </div>
      </article>
      </li>';
  }
  echo '</ul>';

}
  

?>
