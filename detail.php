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
  // its an array in an array
  $itemContent = $itemContent[0];
  echo '
  <div class=container> 
    <div class=image>
      <img src="images\\'.$itemContent[3].'"  style="width:500px;height:500px;">
    </div>
    <div class = text>
      <div>
      <h2> '.$itemContent[0].' </h2>
      </div>
      <div>
      <span> '.$itemContent[2].' </span>
      </div>
      <div>
        <span class=price>'.$itemContent[1].' euro </span>
      </div>
    </div>  
  </div>
  </p>';
}

?>
