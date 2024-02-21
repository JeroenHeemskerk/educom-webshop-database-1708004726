<?php
function showHeadCart(){
  echo '<title> Cart page </title>';
}

function showHeaderCart(){
  echo '<header class=title><h1> Winkelwagen </h1></header>';
}



function showContentCart($content){
  $costs = 0.00;
  // the last two enries of $content aren't relevant
  // call upon a function to filter out the unneeded entires
  $content = removeNonBodyArray($content);
  echo '<div class=cartItem> 
  <div class=cartText> </div> 
  <div class=cartText> <span> product Name </span></div>
  <div class=cartText> <span> Aantal </span> </div>
  <div class=cartText> <span> Prijs per stuk</span> </div>
  </div>'; 
  foreach ($content as $key => $value){
    //var_dump($content[$key]);
    
    $orderAmount = $content[$key]['count'];
    $price = $content[$key][0]['price'];
    $name = $content[$key][0]['name'];
    $image = $content[$key][0]['image'];
    $costs  += $orderAmount * $price;
    ;
      echo '
      <div class=cartItem> 
        <div class=cartImage>
        <a class=product_image  href="index.php?page=product-'.$name.'-'.$key.'"> 
        <img src="images\\'.$image.'"  style="width:64px;height:64px;"> 
        </a>
        </div> 
        <div class=cartText> <span>'.$name.' </span></div>
        <div class=cartText> <span>'.$orderAmount.'</span> </div>
        <div class=cartText> <span> &euro;'.$price.'</pspan> </div>
      </div>'; 
    
  }
  echo '<div class=cartItem> 
  <div class=cartText> </div> 
  <div class=cartText> </div>
  <div class=cartText> </div>
  <div class=cartText> <span>Totaal prijs <br> &euro;'.$costs.'</span> </div>
  </div>'; 

  echo' <div class=cartItem>
  <div class=cartText> </div> 
  <div class=cartText> </div>
  <div class=cartText> </div>
  <div>
  <form action="index.php?page=cart" method="POST">
  <input type="hidden" name="page"value="cart">
  <input type="hidden" name="action" value="placeOrder">
  <button type="submit">Plaats bestelling</button>
  </form>
  </div>
  </div>
  ';

  
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