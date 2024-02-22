<?php
function showHeadWebshop(){
  echo '<title> Shop page </title>';
}

function showHeaderWebshop(){
  echo '<header class=title><h1> Shop </h1></header>';
}

function showContentWebshop($data){
  $data = removeNonBodyArray($data);
    if(isset($data['error'])){
      echo 'Database kan momenteel niet bereikt worden';
    }

    echo '<ul class=items>';
    foreach ($data as $x) {
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
        <span class=price>&euro;'.$x['price'].'  </span>
        </div>';
      // show button for adding to shopping cart
      addToCartButton('webshop', $x['id']);

      echo '</article>
      </li>';
    }
    echo '</ul>';
} 


?>
