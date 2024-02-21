<?php
function prepareDetail($page){
  $details = array();
  $detail['nameAndId'] = explode( '-',  $page, 2)[1];
  $detail['name'] = explode( '-',  $page, 3)[1];
  $detail['id']  = explode( '-',  $page, 3)[2];
  try{
    $detail['items'] = getItemsFromDB('name, price, description, image', 'products', 'id='.$detail['id']);
    } catch (exception $e) {$details['error'] = 'Kon database niet bereiken';
  }
  return $detail;
}

function showHeadDetail($item){
  echo '<title> '.$item.'</title>';
}

function showHeaderDetail($item){
  echo '<header class=title><h1> '.$item.' </h1></header>';
}

function showContentDetail($item){
  // its an array in an array
  $id = $item['id'];
  $item = $item['items'][0];
  echo '
  <div class=container> 
    <div class=image>
      <img src="images\\'.$item['image'].'"  style="width:500px;height:500px;">
    </div>
    <div class = text>
      <div>
      <h2> '.$item['name'].' </h2>
      </div>
      <div>
      <span> '.$item['description'].' </span>
      </div>
      <div>
        <span class=price>&euro;'.$item['price'].'  </span>
      </div>
      <div>';
      addToCartButton('webshop', $id);
  echo '</div>    
    </div>  
  </div>';
}

?>
