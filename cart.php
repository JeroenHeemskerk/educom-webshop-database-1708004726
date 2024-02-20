<?php
function showHeadCart(){
  echo '<title> Cart page </title>';
}

function showHeaderCart(){
  echo '<header class=title><h1> Winkelwagen </h1></header>';
}

function showContentCart(){
  $costs = 0.00;
  $basket = getSessionBasket();
  echo '<div class=cartItem> 
  <div class=cartText> </div> 
  <div class=cartText> <span> product Name </span></div>
  <div class=cartText> <span> Aantal </span> </div>
  <div class=cartText> <span> Prijs per stuk</span> </div>
  </div>'; 
  
  foreach ($basket as $x => $y){
    //echo $x;
    //echo $y;
    if ($y != 0) {
      // okay $x is the id, need to remove the first character from that to fetch from database
      // second, I need to know how many of item are needed
      $orderAmount = $basket[$x];
      $x =  substr($x, 1); 
      // time to get from database 
      $item = getItemsFromDB('name, price, image', 'products', 'id='.$x);
      $item = $item[0];
      echo '
      <div class=cartItem> 
        <div class=cartImage>
        <a class=product_image  href="index.php?page=product-'.$item['name'].'-'.$x.'"> 
        <img src="images\\'.$item['image'].'"  style="width:64px;height:64px;"> 
        </a>
        </div> 
        <div class=cartText> <span>'.$item['name'].' </span></div>
        <div class=cartText> <span>'.$orderAmount.'</span> </div>
        <div class=cartText> <span> &euro;'.$item['price'].'</pspan> </div>
      </div>'; 
        // gotta calculate how much it costs
        $costs  += $orderAmount * $item['price'];
    }
  }
  echo '<div class=cartItem> 
  <div class=cartText> </div> 
  <div class=cartText> <span> </span></div>
  <div class=cartText> <span></span> </div>
  <div class=cartText> <span>Totaal prijs <br> &euro;'.$costs.'</span> </div>
  </div>'; 

  
}


function addToCartButton($page, $id){
  if (isset($_SESSION['userName'])){
    echo '
    <form action="index.php?page=cart" method="POST">
    <input type="hidden" name="page"value="cart">
    <input type="hidden" name="action" value="addToCart">
    <input type="hidden" name="id" value="'.$id.'">
    <button type="submit">Toevoegen aan bestelling</button>
    </form>';
  }
}


?>