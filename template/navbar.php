
   <nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            
          </button>

          <a href="./" class="navbar-brand">Online Gadget Store</a>
         </div> 

         <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./">Home</a></li>
              <?php if (isset ($_SESSION['login'])): ?>
                  <?php if (!empty($_SESSION['admin'])): ?>
                    <li><a href="product-create.php">Add new Product</a></li>
                    <li><a href="services.php">Manage Services</a></li>
                  <?php endif; ?>
                <li><a href="cart.php">My Cart</a></li>
              <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="sign-up.php">Sign Up</a></li>
              <?php endif; ?>
             </ul>
              <a class="btn navbar-btn btn-success pull-right" id="cart-btn-top" href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge"><?=(!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0) ?></span></a>
              <ul class="nav navbar-nav navbar-right">
                <li>
                </li>
            <?php if (isset ($_SESSION['login'])): ?>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout [<?=$_SESSION['name'] ?>]</a></li>
            <?php endif; ?>
              </ul>
         </div>          
      </div>
   </nav> 