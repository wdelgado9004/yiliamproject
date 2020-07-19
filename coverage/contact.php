<?php
$pageTitle = 'Contact Us';
require 'includes/header.php';

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
