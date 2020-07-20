
<?php
  require 'includes/header.php';
  $pageTitle = 'Home';

  ?>
<!doctype html>
<html lang="en">
 

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Welcome to Sandy's Pet Shop</h1>
  <p class="lead">YOUR #1 ONLINE PET STORE</p>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">New Arrival</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Starting at $5 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
                <img src="images/newarrivals.jpeg" alt="Logo" style="width:200px;" >
        </ul>
        <a class="btn btn-lg btn-primary" href="newarrivals.php" role="button">View All</a>
        
       
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Best Sellers</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Starting at $15 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
                <img src="images/bestsellers.jpeg" alt="Logo" style="width:300px;" >
        </ul>
        <a class="btn btn-lg btn-primary" href="bestseller.php" role="button">View All</a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Food</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">Starting at $29 <small class="text-muted"></small></h1>
        <ul class="list-unstyled mt-3 mb-4">
                <img src="images/food.jpeg" alt="Logo" style="width:300px;" >
        </ul>
        <a class="btn btn-lg btn-primary" href="food.php" role="button">View All</a>
      </div>
    </div>
  </div>

  <?php
  require 'includes/footer.php';

  ?>
</div>
</body>
</html>
