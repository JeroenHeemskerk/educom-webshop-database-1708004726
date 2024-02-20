<?php
function showHeadDetail($item){
  $itemOnPage = explode( '-',  $item, 2)[1];
  echo '<title> '.$itemOnPage.'</title>';
}

function showHeaderDetail($item){
  $itemHeader = explode( '-',  $item, 3)[1];
  echo '<header class=title><h1> '.$itemHeader.' </h1></header>';
}

function showContentDetail($item){
  $itemId = explode( '-',  $item, 3)[2];
  $itemContent = getItemsFromDB('name, price, description, image', 'products', 'id='.$itemId);
  $itemContent = $itemContent[0];
  // its an array in an array
  echo '
  <div class=container> 
    <div class=image>
      <img src="images\\'.$itemContent['image'].'"  style="width:500px;height:500px;">
    </div>
    <div class = text>
      <div>
      <h2> '.$itemContent['name'].' </h2>
      </div>
      <div>
      <span> '.$itemContent['description'].' </span>
      </div>
      <div>
        <span class=price>&euro;'.$itemContent['price'].'  </span>
      </div>
      <div>';
      addToCartButton('webshop', $itemId);
  echo '</div>    
    </div>  
  </div>';
}

?>
