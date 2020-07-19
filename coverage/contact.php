<?php
$pageTitle = 'Contact Us';
// require 'header.php';

$f = [];

// Trim and Assign Form Entries
$f['first-name'] = trim($_POST['first-name'] ?? '');
$f['last-name'] = trim($_POST['last-name'] ?? '');
$f['email'] = trim($_POST['email'] ?? '');
$f['message'] = trim($_POST['message'] ?? '');
$f['placeholder'] = 'Be it poetry. Be it prose.
This is where your message goes.';


if (isset($_POST['send'])) {
  require_once 'mail-config.php';
  
  $errors = [];

  if (!$f['first-name']) {
    $errors[] = 'First name is required.';
  }

  if (!$f['last-name']) {
    $errors[] = 'Last name is required.';
  }

  if (!$f['email']) {
    $errors[] = 'Email is required.';
  } elseif (!filter_var($f['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = nl2br(POEM_INVALID_EMAIL);
  }

  if (strlen($f['message']) < 10) {
    $errors[] = 'Your message must be at least 10 characters long.';
  }

  if ($errors) {
    echo '<h3>Please correct the following errors:</h3>
    <ol class="error">';
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo '</ol>';
  } else {
    $to = $f['email'];
    $toName = $f['first-name'] . ' ' . $f['last-name'];
    $subject = 'Contact Form Submission';

    $html = "<p>Oh, happy day, we are touched<br>
    You took the time to contact us<br>
    We <em>will</em> take note<br>
    Of what you wrote<br>
    Thank you <em>very</em>, very much!</p>
    <p>Name: $toName</p>
    <p>Email: " . $f['email'] . "</p>
    <h3>Your Message</h3>" . nl2br($f['message']);

    $text = "Oh, happy day, we are touched
You took the time to contact us
We will take note
Of what you wrote
Thank you very, very much!
    
* Name: $toName
* Email: " . $f['email'] . "
* Your Message: " . $f['message'];

    echo '<article class="poem">';
    try {
      // Pass true to createMailer() to enable debugMode
      $mail = createMailer();
      $mail->addAddress($to, $toName);
      // $mail->addBcc('you@example.com');
      $mail->Subject = $subject;
      $mail->Body = $html;
      $mail->AltBody = $text;
  
      $mail->send();
      echo '<p class="success">' . nl2br(POEM_MAIL_SUCCESS) . '</p>';
    } catch (Exception $e) {
      echo '<p class="error">' . nl2br(POEM_MAIL_FAIL) . '</p>';
      logError($e);
    }
    echo '</article>';
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <!-- <title>Contact Us</title> -->

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">
    <!-- FontAwsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Sandy's Pet Shop</h5>
  <nav class="my-2 my-md-0 mr-md-3">
      <a class="navbar-brand" href="#">
          <img src="logo.jpg" alt="Logo" style="width:90px;" >
        </a>
      <a class="p-2 text-dark" href="index.html"><i class="fa fa-fw fa-home"></i>Home</a>
      <a class="p-2 text-dark" href="about.html"><i class="fa fa-fw fa-book"></i>About Us</a>
      <a class="p-2 text-dark" href="location.html"><i class="fa fa-fw fa-location-arrow"></i>Store Location</a>
      <a class="p-2 text-dark" href="contact.html"><i class="fa fa-fw fa-mobile"></i>Contact Us</a>
      <a class="p-2 text-dark" href="grooming.html"><i class="fa fa-fw fa-newspaper-o"></i>Grooming</a>
    </nav>

</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Contact Us</h1>
 
</div>

<div class="container">
    <form id="contactForm">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">First Name*</label>
            <input type="firstname" class="form-control" id="firstname" required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">Last Name*</label>
            <input type="lastname" class="form-control" id="lastname" required>
          </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email*</label>
              <input type="email" class="form-control" id="email" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lascitytname">City</label>
              <input type="city" class="form-control" id="city">
            </div>
        
        
        
          </div>
          <div class="mb-3">
              <label for="validationTextarea">Message*</label>
              <textarea class="form-control" id="validationTextarea"  required></textarea>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
        </div>
        <div class="form-group">
          
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
      </form>
    
  </div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <img class="mb-2" src="/docs/4.5/assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
        <small class="d-block mb-3 text-muted">&copy; 2010-2020</small>
      </div>
      <div class="col-6 col-md">
        <h5>Bussines Hours</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" >Monday : Closed</a></li>
          <li><a class="text-muted" >Tuesday - Saturday : 10:00 -21:00</a></li>
          <li><a class="text-muted" >Sunday : 10:00 - 17:00</a></li>
       
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Local Services</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Veterinaries </a></li>
          <li><a class="text-muted" href="#">Spa</a></li>
          <li><a class="text-muted" href="#">Kennels</a></li>
          
        </ul>
      </div>
 
       
      </div>
    </div>
  </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script>
      $("#contactForm").validate();
      </script>
</body>
</html>
