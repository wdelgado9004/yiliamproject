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
  
  $pageTitleTag = empty($pageTitle)
              ? 'The Poet Tree Club'
              : $pageTitle . ' | The Poet Tree Club';

  $pathStart = $pathStart ?? '';
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Frank+Ruhl+Libre:300,400">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Assistant">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" crossorigin="anonymous"
  href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
  integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU">
<link rel="stylesheet" href="<?= $pathStart ?>../../../static/styles/normalize.css">
<link rel="stylesheet" href="<?= $pathStart ?>../../../static/styles/styles.css">
<script src="<?= $pathStart ?>../../../static/scripts/scripts.js"></script>
<title><?= $pageTitleTag ?></title>
</head>
<body>
<header>
  <nav id="main-nav">
    <!-- Bar icon for mobile menu -->
    <div id="mobile-menu-icon">
      <i class="fa fa-bars"></i>
    </div>
    <ul>
      <li><a href="<?= $pathStart ?>index.php">Home</a></li>
      <li><a href="<?= $pathStart ?>poems.php">Poems</a></li>
      <li><a href="<?= $pathStart ?>poem-submit.php">Submit Poem</a></li>
      <?php if (isset($_SESSION['user-id'])) { ?>
        <li><a href="<?= $pathStart ?>my-account.php">My Account</a></li>
      <?php } else { ?>
        <li><a href="<?= $pathStart ?>login.php">Log in / Register</a></li>
      <?php } ?>
      <li><a href="<?= $pathStart ?>contact.php">Contact us</a></li>
    </ul>
  </nav>
  <h1>
    <a href="<?= $pathStart ?>index.php">The Poet Tree Club</a>
  </h1>
  <h2>Set your poems free...</h2>
</header>