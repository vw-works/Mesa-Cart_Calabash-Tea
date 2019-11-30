
<div style="float:right;margin-top:200px">
  Products Seen<br/>
  <?php
  $seen = $_SESSION['products_seen'];
  $seenarr = array_reverse(explode('|',$seen));
  foreach ($seenarr as $prod){
    $proddata = explode('^',$prod);
    $productname = $proddata[0];
    $prodlink = $proddata[1];
    echo '<a href= "'.$prodlink.'">'.$productname.'</a><br>';
  }

  ?>
  </div>
