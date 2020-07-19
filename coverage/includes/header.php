<?php
  session_start();
  require_once 'config.php';
  require_once 'utilities.php';
  require_once 'constants.php';
  if (isDebugMode()) {
    ini_set('display_errors', '1');
  }

  // If $db isn't already set, set it.
  if (!isset($db)) {
    $db = dbConnect();
  }

  $currentUserId = $_SESSION['user-id'] ?? 0;
  if (!$currentUserId) {
    // Do we remember this user?
    if (isset($_COOKIE['token'])) {
      $qSelect = "SELECT user_id 
      FROM tokens 
      WHERE token = ? AND token_expires > now()";

      try {
        $stmt = $db->prepare($qSelect);
        $stmt->execute([$_COOKIE['token']]);
    
        if ($row = $stmt->fetch()) {
          // Found unexpired matching token
          $_SESSION['user-id'] = $row['user_id'];
        }
      } catch (PDOException $e) {
        logError($e);
      }
    }
  }
  
 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
  
    <meta name="generator" content="Jekyll v4.0.1">
   
    
<!-- Include Date Range Picker -->

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
    
    </style>
   
   
  </head>
  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">Sandy's Pet Shop</h5>
  <nav class="my-2 my-md-0 mr-md-3">
      <a class="navbar-brand" href="#">
          <img src="images/logo.jpg" alt="Logo" style="width:90px;" >
        </a>
      <a class="p-2 text-dark" href="index.php"><i class="fa fa-fw fa-home"></i>Home</a>
      <a class="p-2 text-dark" href="about.php"><i class="fa fa-fw fa-book"></i>About Us</a>
    <a class="p-2 text-dark" href="location.php"><i class="fa fa-fw fa-location-arrow"></i>Store Location</a>
    <a class="p-2 text-dark" href="contact.php"><i class="fa fa-fw fa-mobile"></i>Contact Us</a>
    <a class="p-2 text-dark" href="grooming.php"><i class="fa fa-fw fa-newspaper-o"></i>Grooming</a>
  </nav>
  </div>