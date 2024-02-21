<?php
function showHeadTop(){
  echo '<title> Top 5 page </title>';
}

function showHeaderTop(){
  echo '<header class=title><h1> Top 5 populairste producten </h1></header>';
}

function showContentTop($content){
  $content = removeNonBodyArray($content);
  // first redirect to a filter function to remove non relevant array elements
  //var_dump($content[0]);
  echo '<ul class=items>';
  foreach ($content as $key => $value) {
      echo '
      <li class=product_webshop>
      <br>
        <article>
        <a class=product_image  href="index.php?page=product-'.$value['name'].'-'.$value['id'].'"> 
        <img src="images\\'.$value['image'].'"  style="width:128px;height:128px;"> 
        </a>
        <h3 class=product_name>
        <a class=product_text href="index.php?page=product-'.$value['name'].'-'.$value['id'].'">
          <span>'.$value['name'].' </span>
        </a>
        </h3>
        </article>
       </li>';
    }

    echo '</ul>';
  }


?>