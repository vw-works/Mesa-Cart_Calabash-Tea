<?
ob_start();
require 'connect.php';
$qty = $_POST['qty'];
if ($qty > 0)
    {
$options = $_POST['options'];
$itemid = $_POST['itemid'];
if ($itemid)
    {
$check = $dbh->prepare("select count(id) from $cartitems where cartitems = ? and sessid = ?"); 
$check->execute(array($itemid,$sessid));
$num = $check->fetchColumn();

if ($num > 0)
     {
$upsql = $dbh->prepare("update $cartitems set qty = qty + ? where cartitems = ? and sessid = ?");	
$upsql->execute(array($qty,$itemid,$sessid));	 
	 }
else
     {	 
$upsql=$dbh->prepare("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	(?,?,?,?,?)");

$time =   date('Y-m-d H:i:s');  

$upsql->execute(array($itemid,$options,$qty,$sessid,$time));

     }

	}

	}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Calabash Tea, Chinese Herbal Tea, Tisane, Homeopathic Remedies, Natural">
    <meta name="author" content="Vila Wong">

    <title>Calabash Tea - Chinese Herbal Teas</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Icons & Fonts -->
    <script src="https://use.fontawesome.com/4675257659.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Roboto:300,500,700" rel="stylesheet"> 
   
    <!-- FOR FOTORAMA PLUGIN -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>

    <!-- Bootstrap core JavaScript (SO NAV WORKS) -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
-->

    <!-- Custom styles-->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link href="cloud-zoom.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/content.css">

    <script type="text/JavaScript" src="cloud-zoom.1.0.2.min.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript">
        function switchpic(pic){
        document.main.src = '<?= $pid;?>/' + pic;	
        }
    </script>

<?
$pid = $_GET['pid'];
if ($_GET['pid']) {
    $opt = $dbh->prepare("select link from $products where id = '$pid'");
    $opt->execute();
    $innerrow = $opt->fetchObject();
    $link = $innerrow->link;
    echo '<link rel="canonical" href="http://projectpixel.altervista.org/webd173_ecomm/mesacart/'.$link.'" />';
    unset($opt);
    unset($innerrow);
}
?>

</head>

<body>

<!--START HEADER -->
        <header class="bg-light">
                <div class="container">
                    <div class="header-row bg-light">
                        <div class="float-left">
                            <a class="brand" href="#">
                            <img src="images/calabash-logo-icon.png" width="40" height="40" class="d-inline-block align-top" alt="Calabash Tea">
                            <span>Calabash Tea</span>
                            </a>
                        </div>
    
                        <div class="float-right user-info">
                            <a class="dropdown" href="#">
                            <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
                            </a>
                            <a class="cart_icon" href="viewcart.php">
                                <span class="fa-stack fa">
                                    <i class="fa fa-circle fa-stack"></i>
                                    <i class="fa fa-shopping-cart fa-stack fa-inverse"></i>
                                </span>
                            </a>
                            <span class="cart-count">
                                <sup>
                                    <? include ('numcart.php');
                                        $sql = "select id, name from $maincategory";
                                        foreach ($dbh->query($sql) as $mainrow)
                                        {
                                        $id = $mainrow[0];
                                        $name = $mainrow[1];
                                        echo '<h5>'.$name.'</h5>';
    
                                        $innersql = "select $category.id,$category.name,count($products.id) from $category,$products WHERE $category.id=$products.catid  and $category.maincatid = '$id' group by $category.id order by $category.name asc";
                                        foreach ($dbh->query($innersql) as $row)
                                        {
                                        $catid = $row[0];
                                        $catname = $row[1];
                                        $prodCount = $row[2];
                                        echo '<a href = "'.$root.'category.php?catid='.$catid.'"> '.$catname.'</a>('.$prodCount.')<br/>';
                                        }
                                        } ?>
                                </sup>
                            </span>
                        </div>
                    </div>
    
                    <div class="clearfix">&nbsp;</div>
    
                   <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                                </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
    
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Get Well Teas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                              <a class="dropdown-item" href="#">Cold &amp; Flu</a>
                              <a class="dropdown-item" href="#">Thoat Soothe</a>
                              <a class="dropdown-item" href="#">Immunity Boost</a>
                            </div>
                          </li>  
    
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Tranquility Teas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                              <a class="dropdown-item" href="#">Sleep Well</a>
                              <a class="dropdown-item" href="#">Stress Less</a>
                            </div>
                          </li>
    
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Accessories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                              <a class="dropdown-item" href="#">Tea Set</a>
                              <a class="dropdown-item" href="#">Tea Filters</a>
                            </div>
                          </li>
    
                        </ul>
                        <div class="dropdown-divider"></div>
                    </div>
                      
                        <div class="search-bar">
                            <form class="form-inline my-lg-0" action="searchres.php" method="post">
                                <input class="form-control" type="text" name="query" placeholder="Search" aria-label="Search">
                                <button class="btn my-sm-0" type="submit" aria-label="Submit"><i class="fa fa-search fa-lg" aria-hidden="true"></i>
                                </button> 
                            </form>
                       </div>
                       
                    </nav>
                </div>
            </header>
<!-- END HEADER -->

<?
    $att = $dbh->prepare("select options from $attributes where  prodid = '$pid'");
    $att->execute();
    $innerrow = $att->fetchObject();
    $attr = $innerrow->options;
    $linearray = explode("\n",$attr);
    $numoptions = count($linearray);

$cat = $dbh->prepare("select $category.id,$category.name,$inv.qty from $category,$products,$inv where 
$products.id = '$pid' and $category.id = $products.catid");
$cat->execute();
$catrow=$cat->fetchObject();
$catid = $catrow->id;
$catname = $catrow->name;
$inv = $catrow->qty;
if ($qty > 0)
    {
$uid = session_id();	
for ($h=1;$h<=$numoptions;$h++)
   {
$options .= $_POST['option'.$h].',';
   }
$options = substr($options,0,strlen($options)-1);$itemid = $_POST['itemid'];
if ($itemid)
    {
$row = $dbh->query("select count(id) from $cartitems where cartitems = '$itemid' and sessid = '$sessid' and attribute = '$options'");  
$num = $row->fetchColumn();

if ($num > 0)
    {
$dbh->exec("update $cartitems set qty = qty + '$qty' where cartitems = '$itemid' and sessid = '$sessid'");
    }
else
    {	 
$count = $dbh->exec("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values	('$itemid','$options','$qty','$sessid',now())");
    }
 }
}	 

$prod = $dbh->prepare("select * from $products where id = '$pid'");
$prod->execute();
$row=$prod->fetchObject();
$breadcrumb = "<a href = \"".$root."index.php\">Home</a>"; 
$name = $row->name;
$breadcrumb .= "</a> / ".$name."<br/><br/>";
 echo $breadcrumb;
 $desc = $row->descrip;
 $price = $row->price; 

if ($price == 0) $price = 'Free!';
 $link = $root.$row->link;
 if ($link == "") $link = $root."product.php?pid=".$pid; 
  $size = getimagesize($pid."/1.jpg");
  $height = $size[1] - 75;
  $width = $size[0] - 75;
    $att = $size[3];
  /*

      <a href='/images/zoomengine/bigimage00.jpg' class = 'cloud-zoom' id='zoom1'

            rel="adjustX: 10, adjustY:-4">

            <img src="/images/zoomengine/smallimage.jpg" alt='' title="Optional title display" />

        </a>

  */

  echo $name.'<br/>'.$desc.'<br/>';
  echo '<a href="'.$pid.'/1.jpg" class = "cloud-zoom" id="zoom1" rel="zoomHeight:250,zoomWidth:250"><img src = "'.$pid.'/1.jpg" name = "main" alt="" title="'.$name.'" height="200" width ="300" ></a><br/>';
  $open = opendir($pid);
  $y = 1;
  while ($file = readdir($open))
    {
if ($file == '1.jpg' || $file == '.' || $file == '..') continue;
//echo '<img src = "thumbnail.php?pic='.$id.'/'.$file.'" onclick=switchpic(\''.$file.'\');"/>';
echo '<a href="'.$pid.'/'.$file.'" class="cloud-zoom-gallery" title="" rel="useZoom:\'zoom1\',smallImage:\''.$pid.'/'.$file.'\'"><img class="zoom-tiny-image" src="'.$pid.'/'.$file.'" alt = "Thumbnail '.$y.'" height = "100" width = "100"/></a>';
$y++;
   }
echo "Inventory: ".$inv."<br/>";
  ?>

<form action = "product.php?pid=<?= $pid;?>" method="post">
<input type="hidden" name = "itemid" value = "<?= $pid;?>" />

<?
$y=1;
for ($z=0;$z<count($linearray);$z++)
  {
$atribarray = explode(',',$linearray[$z]);
if (count($atribarray)>1)
   {
echo '<select name = "option'.$y.'">';   
   for ($x=0;$x<count($atribarray);$x++)
     {
 echo '<option value = "'.$atribarray[$x].'">'.$atribarray[$x].'</option>';
	 }   
 echo '</select>';   
 $y++;
   }

  }
?>

<br/>

Quantity

<input type = "text" name = "qty" size="2" />

<input type = "submit" value = "add to cart" />

</form><br/>  

  <? 

  $avg = $dbh->prepare("select avg($rating.rating) as average

 from $rating

 where prodid = $pid");

$avg->execute();

$avgrow=$avg->fetchObject();

$score = $avgrow->average;

for ($i=1;$i<=5;$i++)

  {

if ($i<=ceil($score)) echo '<img src = "images/favorite.png" height="15" width = "15">'; 

else echo  '<img src = "images/favorite1.png" height="15" width = "15">'; 

  }

  $dbh=null;

?>

<br/><br />

<a href = "<?= $root;?>viewcart.php">View your cart</a> 

</body>

</html>

