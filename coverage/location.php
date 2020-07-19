<?php
require 'includes/header.php';
$pageTitle = 'Store Location';

?>
<!doctype html>
<html lang="en">

<style>
    /* Set the size of the div element that contains the map */
  #map {
    height: 400px;  /* The height is 400 pixels */
    width: 100%;  /* The width is the width of the web page */
    }
</style>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
<h1 class="display-4">Store Location </h1>

</div>
<div class="container-fluid">
<div class="row">
<div class="col-sm">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
  <h5 class="card-title">Bussiness Hours</h5>
  <p class="card-text">Monday: Closed </p>
  <p class="card-text">Tuesday - Saturday : 10:00 -21:00 </p>
  <p class="card-text">Sunday : 10:00 - 17:00 </p>
  <h5 class="card-title">Address</h5>
  <p class="card-text"> 549 NY-17, Tuxedo Park, NY 10987, United States</p>
  
    </div>
  </div>
</div>

  <div class="col-sm">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001.324997327499!2d-74.18737728476138!3d41.214687579280465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2df32fb05a151%3A0x8c7bd04c0bea2fa2!2s549%20NY-17%2C%20Tuxedo%20Park%2C%20NY%2010987%2C%20USA!5e0!3m2!1sen!2sca!4v1595192027569!5m2!1sen!2sca" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</div>      
</div>


<?php
require 'includes/footer.php';

?>
</div>
</body>
</html>
