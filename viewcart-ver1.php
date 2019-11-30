<?
ob_start();
require 'connect.php';
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
       
        <!-- FOR FOTORAMA PLUGIN
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> 
        <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>  -->
    
        <!-- Bootstrap core JavaScript (SO NAV WORKS) -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <!-- Custom styles-->
        <link href="css/heroic-features.css" rel="stylesheet">
        <link rel="stylesheet" href="css/navstyle.css">
        <link rel="stylesheet" href="css/content.css">
       
        <script type="text/javascript">
function sameship() {
    if (document.getElementById("ship").checked == true)
       {
document._xclick.billfirst_name.value = document._xclick.first_name.value;     
document._xclick.billlast_name.value = document._xclick.last_name.value;    
document._xclick.billaddress1.value = document._xclick.address1.value   ; 
document._xclick.billcity.value = document._xclick.city.value ;   
  document._xclick.billstate.value = document._xclick.state.value;    
  document._xclick.billzip.value = document._xclick.zip.value; 
       }
else {
document._xclick.billfirst_name.value = '' ;    
document._xclick.billlast_name.value = '';  
document._xclick.billaddress1.value = ''   ; 
document._xclick.billcity.value =   '' ;    
document._xclick.billstate.value =  '';   
document._xclick.billzip.value =  ''; 
    }
}
        </script>

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
<!-- START CONTENT -->
<div>
    <!-- PRODUCTS IN CART AND TOTALS -->
    <div id="cart-sum" class="content-sec">
        <div class="container">

        <!--BREADCRUMB-->
        <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart Review</li>
                </ol>
        </nav>

        <h3 class="cart-pg-h">Your Order:</h3>
            <hr>
        <!-- PRODUCTS IN CART -->
<?php
        $newsql = "select $cartitems.cartitems,$products.name,$products.price ,$cartitems.qty,$products.id,$cartitems.attribute from $cartitems,$products where $cartitems.sessid = '$sessid' and $cartitems.cartitems = $products.id";
foreach ($dbh->query($newsql) as $row)  
  {
 $name = $row[1];
 $price = $row[2];
 $qty = $row[3];
 $prodid = $row[4];
 $attribute = $row[5];
 $weight = $showrow[7];
 ?>
            <div class="row">



                <div class="col-md-6 mb-3">
                    <div class="thumbnail float-left">
                        <img src="thumbnail.php?pic=<?php echo $prodid;?>/1.jpg&ht=100&wd=100">
                    </div>

                    <div class="prod-sum float-left ml-3 mt-2">
                        <p><span class="product-title"><?php echo $name;?></span></p>
                        <p><span class="price"><?php echo $price;?></span></p>
                    </div>
                </div>

                <div class="col-md-4 mb-3 mt-1">
                    <div class="text-md-right">
                        <span class="sm-brn-cap">Quantity:</span>
                        <input type = "text" name = "qty" size="2" class="qty text-center lite-focus" value="<?php echo $qty;?>">
                    </div>
                </div>

                <div class="col-md-2 mb-3 mt-1 text-md-center">
                    <a href="#" id="remove" class="link">Remove</a>
                </div>
            </div>
            <?php
        }
        ?>

            <!-- /.row -->
            <!-- END PRODUCTS IN CART -->

            <hr>
            <div class="row">
                <div class="col">
                    <a href="index.php" class="btn btn-secondary btn-outline lite-focus px-2 py-1">Continue Shopping</a>
                </div>
                <div class="col text-right">
                    <input class="btn btn-secondary btn-outline lite-focus px-2 py-1" type="submit" name="submit" value="update">
                </div>
            </div><!-- /.row -->

            <hr>
            <div class="row">
                    <div class="col-4">
                        <span class="sm-brn-cap">Subtotal:</span>
                    </div>
                    <div class="col-8 text-right">
                        <p>$Subtotal Value</p>
                    </div>
            </div><!-- /.row -->

            <div class="row">
                    <div class="col-4">
                        <span class="sm-brn-cap">Shipping:</span>
                    </div>
                    <div class="col-8 text-right">
                        <p>$Shipping Price</p>
                    </div>
            </div><!-- /.row -->

            <hr class="mt-0 pt-0">
            <div class="row">
                    <div class="col-2">
                        <span class="sm-brn-cap">Total:</span>
                    </div>
                    <div class="col-10 text-right">
                        <p class="price">$Total Value</p>
                    </div>
            </div><!-- /.row -->
            
        </div><!-- /.container -->
    </div><!-- /#cart-sum -->

    <!--SHIPPING SECTION -->
        <div id="cart-ship" class="content-sec">
             <div class="container">
                <h3 class="cart-pg-h">Shipping</h3>
                <hr>
                
                <form action= "https://www.sandbox.paypal.com/us/cgi-bin/webscr" method="post"  name="_xclick" id="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">First name</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom01" name="first_name" placeholder="First Name" required onblur="sameship();">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="validationCustom02">Last name</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom02" name="last_name" placeholder="Last Name" required onblur="sameship();">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            <label for="validationCustom06">Address</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom06" name="address1" placeholder="Address" required onblur="sameship();">
                            
                            <div class="invalid-feedback">
                                Please provide a valid address.
                            </div> 
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">City</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom03" name="city" placeholder="City" required onblur="sameship();">
                            
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div> 
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">State</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom04" name="state" placeholder="State" required onblur="sameship();">
                            
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">Zip</label>
                            <input type="text" class="form-control lite-focus" id="validationCustom05" name="zip" placeholder="Zip" required onblur="sameship();">
                            
                            <div class="invalid-feedback">
                                Please provide a valid zip.
                            </div>
                        </div>
                    </div>
                   <!-- <row>
                        <button class="btn btn-secondary btn-outline lite-focus px-2 py-1" type="submit">Next</button>
                    </row>  
                    
                <!-- </form> -->
            </div> <!-- /.container-->
        </div><!-- /#cart-ship-->
                  
        <div id="cart-bill" class="content-sec">
                <div class="container">

                <h3 class="cart-pg-h">Billing</h3>
                    <hr>

                    <p> 
                        Use same address as shipping
                        <input type = "checkbox" id="ship" onClick="sameship();">
                    </p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom07">First name</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom07" name="billfirst_name" placeholder="First Name" required onblur="sameship();">
                            </div>
    
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom08">Last name</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom08" name="billlast_name" placeholder="Last Name" required onblur="sameship();">
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col mb-3">
                                <label for="validationCustom09">Address</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom09" name="billaddress1" placeholder="Address" required onblur="sameship();">
                                
                                <div class="invalid-feedback">
                                    Please provide a valid address.
                                </div> 
                            </div>    
                        </div>
    
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="validationCustom10">City</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom10" name="billcity" placeholder="City" required onblur="sameship();">
                                
                                <div class="invalid-feedback">
                                    Please provide a valid city.
                                </div> 
                            </div>
    
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom11">State</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom11" name="billstate" placeholder="State" required onblur="sameship();">
                                
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
    
                            <div class="col-md-3 mb-3">
                                <label for="validationCustom12">Zip</label>
                                <input type="text" class="form-control lite-focus" id="validationCustom12" name="billzip" placeholder="Zip" required onblur="sameship();">
                                
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>

                        <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom13">Phone Number</label>
                                    <input type="text" class="form-control lite-focus" id="validationCustom13" name="night_phone_a" placeholder="Phone #" required onblur="sameship();">
                                </div>
        
                                <div class="col-md-6 mb-3">
                                    <label for="validationCustom14">Email</label>
                                    <input type="text" class="form-control lite-focus" id="validationCustom14" name="email" placeholder="youremail@email.com" required onblur="sameship();">
                                </div>
                        </div>

                            <button class="btn btn-primary btn-outline lite-focus" type="submit">Checkout</button>
                    </form>
                    
                </div><!-- /.container -->
            </div><!-- /#cart-bill -->



</div>

</body>
</html>
