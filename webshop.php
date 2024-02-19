<?php
function showHeadWebshop(){
  echo '<title> Shop page </title>';
}

function showHeaderWebshop(){
  echo '<header class=title><h1> Shop </h1></header>';
}

function showContentWebshop(){
  $items = getItemsFromDB('id, name, price, image');
  if ($items) {
    // figure out alternative to BR later
    // display items in list?
    echo '<ul class=items>
    <li class=product_webshop>
    <br>
      <article>
      <a class=product_image  href="index.php?page=detail"> 
      <img src="images\\'.$items['image'].'"  style="width:128px;height:128px;"> 
      </a>
      <h3 class=product_name>
      <a class=product_text href="index.php?page=detail">
        <span>'.$items['name'].' 
      </h3>
      <div class=product_price>
        <span>'.$items['price'].'
      </div>
      </article>
      </li>
    </ul>';

  } else {
    echo 'Het database kan momenteel niet bereikt worden';
  }
  
}

?>
