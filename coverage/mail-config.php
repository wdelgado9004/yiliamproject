<?php
  /*
    This config file is specific to the development machine.
    The config file on production will have the same
      functions, but they will return different values.
  */
  //Import PHPMailer classes into the global namespace
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  use PHPMailer\PHPMailer\SMTP;

  
  require_once "PHPMailer/PHPMailer.php";
  require_once "PHPMailer/SMTP.php";
  require_once "PHPMailer/Exception.php";

  function createMailer($debug=false) {
    $debugMode = $debug ? 2 : 0;
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );
    // Change these values to match your settings
    $mail->Host = "smtp.office365.com"; // hotmail.com or outlook.com
    $mail->Port = 587;
    $mail->Username = 'yilamon@outlook.com'; // SMTP account username
    $mail->Password = 'Mailiy360'; // SMTP account password
    $mail->setFrom('yumar19831@outlook.com', 'Your Name');
    
    // Uncomment the next line and change the email address
    //   if you don't want replies to go to the from address
    // $mail->addReplyTo('donotreply@example.com');
  
    // Don't change values below this
    $mail->IsSMTP(); // use Simple Mail Transfer Protocol
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = 'tls'; // use Transport Layer Security
    $mail->isHTML(true); // send as HTML
    $mail->SMTPDebug = $debugMode; // Debugging. 0 = no debug output
  
    return $mail;
  }
?>