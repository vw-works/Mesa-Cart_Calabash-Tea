<?php
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
$upsql=$dbh->prepare("insert into $cartitems (cartitems,attribute,qty,sessid,timeofentry) values    (?,?,?,?,?)");

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

    <!-- Custom styles-->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/content.css">
    <?
$pid = $_GET['pid'];
if ($_GET['pid']) {
    $opt = $dbh->prepare("select * from $products where id = '$pid'");
    $opt->execute();
    $innerrow = $opt->fetch();
    $name = $innerrow['name'];
    $descrip = $innerrow['descrip'];
    $price = $innerrow['price'];
    $catid = $innerrow['catid'];
    $qty = $innerrow['qty'];
    $link = $innerrow['link'];
  //  if ($link == "") {$link = "product.php?pid=".$id;}
 if (strpos($_SESSION['products_seen'],$name) === false){
$_SESSION['products_seen'] .= "|".$name.'^'.$link;
}
    //get all values of this particular product based on $pid for later population

    echo '<link rel="canonical" href="http://projectpixel.altervista.org/webd173_ecomm/mesacart/'.$link.'" />';

    echo '<title>'.$name.'</title>';

}
?>
   
  </head>

    <body>
        <!--START HEADER -->
        <header class="bg-light">
        <div class="container">
            <div class="header-row bg-light">
                <div class="float-left">
                    <a class="brand" href="index.php">
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
                        </sup></span>
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
                      <a class="dropdown-item" href="product.php?pid=1">Cold &amp; Flu</a>
                      <a class="dropdown-item" href="product.php?pid=2">Thoat Soothe</a>
                      <a class="dropdown-item" href="product.php?pid=3">Immunity Boost</a>
                    </div>
                  </li>  

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Tranquility Teas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                      <a class="dropdown-item" href="product.php?pid=4">Sleep Well</a>
                      <a class="dropdown-item" href="product.php?pid=5">Stress Less</a>
                    </div>
                  </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Accessories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                      <a class="dropdown-item" href="product.php?pid=6">Tea Set</a>
                      <a class="dropdown-item" href="product.php?pid=7">Tea Filters</a>
                    </div>
                  </li>

                  <!--
                    <li class="nav-item">
                    <a class="nav-link" href="#">All Teas</a>
                  </li>
                   -->

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

            <!--START PAGE CONTENT -->
                <div>
                <div class="content-sec">
                     
                  <div class="container">
                     
                    <!--BREADCRUMB-->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $name;?></li>
                        </ol>
                    </nav>

                        <div class="row">

                            <div class="col-md-6">          
                                <div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="500/500" data-arrows="true" data-click="false" data-swipe="true" data-trackpad="true" data-thumbwidth="100" data-thumbheight="100">
                                    <img src="thumbnail.php?pic=<?php echo $pid;?>/1.jpg&ht=500&wd=500" alt="<?php echo $name;?>">
                                    <img src="thumbnail.php?pic=<?php echo $pid;?>/2.jpg&ht=500&wd=500" alt="<?php echo $name;?>">
                                </div>          
                            </div>
        
                            <div class="details col-md-6">
                                <h3 class="product-title"><?php echo $name;?>
                                </h3>
                                   <!-- <div class="rating">
                                        <div class="stars">
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                            </div>
                                        </div>
                                    -->

                                <div class="product-description">
                                    <?php
                                    echo $descrip;
                                    ?>
                                </div>

                                <span class="price">$<?php echo $price;?></span> 
                                <span class="strike-price"></span>

                                <hr>

                                <form action = "product.php?pid=<?php echo $pid; ?>" method="post">
                                    <input type="hidden" name = "itemid" value = "<?php echo $pid; ?>">
                                    
                                    <div class="link-padding float-left">
                                        <span class="sm-brn-cap">Quantity:</span>
                                        <input type = "text" name = "qty" size="2" class="qty text-center lite-focus"/>
                                        
                                    </div>
                                    <div class="float-right">
                                        <input class="btn btn-primary btn-outline lite-focus" type="submit" value="add to cart">
                                    </div>
                                </form>
                            </div>

                        </div> <!-- / .row -->
                    </div> <!-- / .container -->
                </div> <!-- / .content-sec -->
            
                <div class="content-sec">
                    <div class="container text-center">
                            <h4 class="brn">recently viewed products:</h4>
                    <div class="row text-center">
<?php
  $seen = $_SESSION['products_seen'];
  $seenarr = array_reverse(explode('|',$seen));
  foreach ($seenarr as $prod){
    $proddata = explode('^',$prod);
    $productname = $proddata[0];
    $prodlink = $proddata[1];
    if ($productname){
    $prodsql = $dbh->prepare("select id,price from $products where name = '$productname'");
    $prodsql->execute();
    $prodrow = $prodsql->fetch();
    $rid = $prodrow['id'];
    $price = $prodrow['price'];
    $strikeprice = $price+20;

                       ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-subtitle"><?php echo $productname;?>
                                    </p>
                                </div>
                                <img class="card-img-top" src="thumbnail.php?pic=<?php echo $rid;?>/1.jpg&ht=325&wd=500" alt="<?php echo $productname;?>">
                                <div class="card-price">
                                    <span class="price">
                                    $<?php echo $price;?>
                                    </span>
                                    <span class="strike-price">
                                    $<?php echo $strikeprice;?>
                                    </span>
                                </div>
                                    
                                <div class="card-footer">
                                    <a href="product.php?pid=<?php echo $rid; ?>" class="btn btn-primary">See Details</a>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                    }
                    ?>
                    </div>
                    </div>          
                </div>

    <!-- FLOATING HELP SECTION -->

    <div id="help" class="fixed-bottom text-center">
            <a href="#">
                <i class="fa fa-question-circle fa-3x text-center" aria-hidden="true"></i>
                <p class="text-center">Need Help?</p>
            </a>
        </div>
     </div>


        <!-- Footer -->
        <footer class="py-3 content-sec">
          <div class="container">
                <div id="email-subc" class="pl-0 text-center">
                    <h5 class="mb-0 text-center">Signup For Special Offers</h5>
                    
                        <div class="input-group input-group-sm pt-1 pb-3 mx-auto width-50">
                          <input type="email" name="email" class="form-control lite-focus" placeholder="Enter Your Email Address" aria-label="Enter Your Email Address">
                          <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Subscribe</button>
                          </span>
                        </div>
                    
                </div>
              
            <div class="row text-center">
                <div class="col-sm">
                  <h5 class="mb-1">Connect With Us</h5>
                    <p>
                        <a class="" href="#">
                            <span class="fa-stack fa-1x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a class="" href="#">
                            <span class="fa-stack fa-1x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a class="" href="#">
                            <span class="fa-stack fa-1x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                        <a class="" href="#">
                            <span class="fa fa-stack">
                                <i class="fa fa-pinterest fa-2x" aria-hidden="true"></i>
                            </span>
                        </a>
                    </p>     
                </div>
                
                <div class="col-sm">
                  <h5 class="mb-1">Company</h5>
                  <ul>
                    <li><a class="" href="#">Shop All Teas</a></li>
                    <li><a class="" href="#">About</a></li>
                    <li><a class="" href="#">Contact Us</a></li>
                  </ul>
                </div>
                
                <div class="col-sm">
                 <h5 class="mb-1">Quick Links</h5>
                 <ul>
                      <li><a class="" href="#">Terms Of Use</a></li>
                      <li><a class="" href="#">Private Policy</a></li>
                      <li><a class="" href="#">Site Map</a></li>
                  </ul>
                </div>
                
    
          </div>
            <p class="m-0 text-center text-black">Copyright &copy; Calabash Tea 2017</p>
          </div>
            
        </footer>

            </body>
            
