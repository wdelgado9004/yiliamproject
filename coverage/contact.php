<?php
$pageTitle = 'Contact Us';
require 'includes/header.php';

$f = [];

// Trim and Assign Form Entries
$f['firstname'] = trim($_POST['firstname'] ?? '');
$f['lastname'] = trim($_POST['lastname'] ?? '');
$f['email'] = trim($_POST['email'] ?? '');
$f['city'] = trim($_POST['city'] ?? '');
$f['message'] = trim($_POST['message'] ?? '');



if (isset($_POST['send'])) {
  require_once 'mail-config.php';
  
  $errors = [];

  if (!$f['firstname']) {
    $errors[] = 'First name is required.';
  }

  if (!$f['lastname']) {
    $errors[] = 'Last name is required.';
  }

  if (!$f['email']) {
    $errors[] = 'Email is required.';
  } elseif (!filter_var($f['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = nl2br(INVALID_EMAIL);
  }

  if (strlen($f['message']) < 10) {
    $errors[] = 'Your message must be at least 10 characters long.';
  }

  if ($errors) {
    echo '<h3></h3>
    <ol class="error">';
    foreach ($errors as $error) {
      echo "<li>$error</li>";
    }
    echo '</ol>';
  } else {
    $to = $f['email'];
    $toName = $f['firstname'] . ' ' . $f['lastname'];
    $subject = 'Contact Form Submission';

    $html = "
    <p>Name: $toName</p>
    <p>Email: " . $f['email'] . "</p>
    <h3>Your Message</h3>" . nl2br($f['message']);

    $text = "

    
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
      echo '<p class="success">' . nl2br(MAIL_SUCCESS) . '</p>';
    } catch (Exception $e) {
      echo '<p class="error">' . nl2br(MAIL_FAIL) . '</p>';
      logError($e);
    }
    echo '</article>';
  }
}
?>
<!doctype html>
<html lang="en">

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Contact Us</h1>
 
</div>

<div class="container">
    <form id="contactForm" method="post" action="contact.php" novalidate>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">First Name*</label>
            <input type="firstname" class="form-control" name="firstname"
            value="<?= $f['firstname'] ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">Last Name*</label>
            <input type="lastname" class="form-control" name="lastname"
            value="<?= $f['lastname'] ?>" required>
          </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email*</label>
              <input type="email" class="form-control" name="email" 
              value="<?= $f['email'] ?>"required>
            </div>
            <div class="form-group col-md-6">
              <label for="lascitytname">City</label>
              <input type="city" class="form-control" name="city" value="<?= $f['city'] ?>">
            </div>
        
        
        
        </div>
        <div class="mb-3">
              <label for="validationTextarea">Message*</label>
              <textarea class="form-control" name="message"  
              value="<?= $f['message'] ?>"required></textarea>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
              
        </div>
        <div class="form-group col-md-6">

        <button name = "send"  type="submit" class="btn btn-primary">Send</button>
          
        </div>
        
      </form>
    
  </div>

  <?php
  require 'includes/footer.php';

  ?>
  
</div>
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
