<!DOCTYPE html>
<?php
ob_start();
require 'connect.php';

$qty = $_POST['qty'];
if ($qty > 0)
    {
$itemid = $_POST['itemid'];
if ($itemid)
    {
$row = $dbh->prepare("select count(*) from $cartitems where sessid = ? and cartitems = ? and attribute = ?");  
$row->bindValue(1,$sessid);
$row->bindValue(2,$itemid);
$row->execute();
$num = $row->fetchColumn();
if ($num > 0)
    {
$sth = $dbh->prepare("update $cartitems set qty = qty + ? where cartitems = ? and sessid = ?");
$sth->execute(array($qty,$options,$itemid,$sessid));
    }
else
    {  
$sth=$dbh->prepare("insert into $cartitems (cartitems,qty,sessid,timeofentry) values (?,?,?,?)");
$time =   date('Y-m-d H:i:s');  
$sth->execute(array($itemid,$qty,$sessid,$time));
    }
 }
} 
?>

<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Calabash Tea, Chinese Herbal Tea, Tisane, Homeopathic Remedies">
    <meta name="author" content="Vila Wong">

    <title>Calabash Tea - Search Results</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles-->
    <link href="css/heroic-features.css" rel="stylesheet">
    <link rel="stylesheet" href="css/navstyle.css">
    <link rel="stylesheet" href="css/content.css">
    
    <!-- Custom Icons & Fonts -->
    <script src="https://use.fontawesome.com/4675257659.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Roboto:300,500,700" rel="stylesheet"> 

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
        
    <!-- Page Content -->
    <div class="wrapper">
        
    <div class="content-sec">
    <div class="container">
        
        <h3>Search Results for: <?php 
        $query = $_POST['query'];
        echo $query;?></h3>
    
        <hr>
        
       <!-- <form action = "searchres.php" method = "post">
            Search: <input type = "text" name = "query" /><br/>
            <input type = "submit" name = "submit" value = "Search!" />
        </form> -->
        
      <div class="row text-center">
       
          
        <?
        if ($query){
        $secondsql = "select $products.id,$products.name,$products.descrip,$products.price,$category.id,$category.name 
        from $spec,$products,$category where $products.id = $spec.prodid and $products.catid = $category.id and ($products.name like '%$query%' or $products.descrip like '%$query%' or $category.name like '%$query%')";
       
        $stm = $dbh->prepare($secondsql);
        $stm->execute();
      
          $stm = $dbh->prepare($secondsql);
          $stm->execute();
          foreach ($stm->fetchAll() as $secondrow)
          {
        echo '<div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                <div class="card-title">  
                ';
                $img = $secondrow[0].'/1.jpg';
                $name = $secondrow[1];
                $desc = $secondrow[2];
                $price = $secondrow[3];
                $catid = $secondrow[4];
                $catname = $secondrow[5];
                $id = $secondrow[0];
                $link = $secondrow[6];
                if ($link == "") $link = "product.php?pid=".$id; 
                //price
                ' </div> ';
                //product name which links to product page
                echo '<p class="card-subtitle"><a href="' .$link. '" title="'.$name.'">' .$name. '</a></p>
                </div>
                <img class="card-img-top" src = "thumbnail.php?pic='.$img.'&ht=500&wd=500" alt="'.$name.'">
                <span class="price"> $'.$price.'</span>
                
                <div class="card-footer">
                    <form action = "index.php" method="post">
                    <input type="hidden" name = "itemid" value = "'.$id.'" />
                    <input type = "hidden" name = "qty" value="1" />
                    <input class="btn btn-primary text-center" type = "submit" value = "add to cart" /></form>
                </div></div></div></div>';
                  }
                      $dbh = null;
                    }
                ?>
          
        </div>
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-sec -->
        
   
        
    <!-- FLOATING HELP SECTION -->

    <div id="help" class="fixed-bottom text-center">
        <a href="#">
            <i class="fa fa-question-circle fa-3x text-center" aria-hidden="true"></i>
            <p class="text-center">Need Help?</p>
        </a>
    </div>
 </div>
      <!-- /.wrapper -->
    <!-- Footer -->
    <footer class="py-3 bg-light">
      <div class="container">
            <div id="email-subc" class="pl-0 text-center">
                <h5 class="mb-0 text-center">Signup For Special Offers</h5>
                
                    <div class="input-group input-group-sm pt-1 pb-3 mx-auto width-50">
                      <input type="email" name="email" class="form-control" placeholder="Enter Your Email Address" aria-label="Enter Your Email Address">
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
       
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
