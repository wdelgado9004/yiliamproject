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