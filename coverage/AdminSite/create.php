<?php
  $pageTitle = 'New Grooming';
  require 'includes/header.php';

  $f = [];

  if($_SERVER["REQUEST_METHOD"] == "GET" and isset($_REQUEST['editId']) and $_REQUEST['editId']!=""){
    $query = "SELECT * FROM grooming
    WHERE GroomingID = ".$_REQUEST['editId'];
    try {
        $stmt = $db->prepare($query);
        if (!$stmt->execute()) {
          $errorMsg = $stmt->errorInfo()[2] . ": $query";
          logError($errorMsg);
        }
        $row = $stmt->fetch();
        $f['FirstName'] = trim($row['FirstName'] ?? '');
        $f['LastName'] = trim($row['LastName'] ?? '');
        $f['Address'] = trim($row['Address'] ?? '');
        $f['City'] = trim($row['City'] ?? '');
        $f['State'] = trim($row['State'] ?? '');
        $f['Zip'] = trim($row['Zip'] ?? '');
        $f['PhoneNumber'] = trim($row['PhoneNumber'] ?? '');
        $f['Message'] = trim($row['Message'] ?? '');
        $f['Email'] = trim($row['Email'] ?? '');
        $f['PetType'] = trim($row['PetType'] ?? '');
        $f['Breed'] = trim($row['Breed'] ?? '');
        $f['PetName'] = trim($row['PetName'] ?? '');
        $f['NeuteredOrSpayed'] = trim($row['NeuteredOrSpayed'] ?? '');
        $myTime = strtotime(trim($row['PetBirthday'] ?? '')); 
        $f['PetBirthday'] = date("Y-m-d H:i:s", $myTime);
      } catch (PDOException $e) {
        logError($e, true);
      }
  }else{
    $f['FirstName'] = trim($_POST['FirstName'] ?? '');
    $f['LastName'] = trim($_POST['LastName'] ?? '');
    $f['Address'] = trim($_POST['Address'] ?? '');
    $f['City'] = trim($_POST['City'] ?? '');
    $f['State'] = trim($_POST['State'] ?? '');
    $f['Zip'] = trim($_POST['Zip'] ?? '');
    $f['PhoneNumber'] = trim($_POST['PhoneNumber'] ?? '');
    $f['Message'] = trim($_POST['Message'] ?? '');
    $f['Email'] = trim($_POST['Email'] ?? '');
    $f['PetType'] = trim($_POST['PetType'] ?? '');
    $f['Breed'] = trim($_POST['Breed'] ?? '');
    $f['PetName'] = trim($_POST['PetName'] ?? '');
    $f['NeuteredOrSpayed'] = trim($_POST['NeuteredOrSpayed'] ?? '');
    $myTime = strtotime(trim($_POST['PetBirthday'] ?? '')); 
    $f['PetBirthday'] = date("Y-m-d H:i:s", $myTime);
  }

  if (isset($_POST['save'])) {
    $errors = [];
    // Validate Form Entries
    if (!$errors) {
      // Update Grooming
      if($_REQUEST['editId']){
        $qInserts = "UPDATE grooming SET FirstName=:FirstName,LastName=:LastName,
        Address=:Address,City=:City,State=:State,Zip=:Zip,PhoneNumber=:PhoneNumber,
        Email=:Email,PetType=:PetType,Breed=:Breed,PetName=:PetName,NeuteredOrSpayed=:NeuteredOrSpayed,PetBirthday=:PetBirthday
        WHERE GroomingID =".$_REQUEST['editId'];
      }
      //Insert
      else{
        $qInserts = "INSERT INTO grooming(FirstName, LastName, Address, City, State, Zip, 
        PhoneNumber, Email, PetType, Breed, PetName, NeuteredOrSpayed, PetBirthday) 
        VALUES (:FirstName, :LastName, :Address, :City, :State, :Zip, 
        :PhoneNumber, :Email, :PetType, :Breed, :PetName, :NeuteredOrSpayed, :PetBirthday)";
      }
      try {
        $stmtInserts = $db->prepare($qInserts);
        $stmtInserts->bindParam(':FirstName', $f['FirstName']);
        $stmtInserts->bindParam(':LastName', $f['LastName']);
        $stmtInserts->bindParam(':Address', $f['Address']);
        $stmtInserts->bindParam(':City', $f['City']);
        $stmtInserts->bindParam(':State', $f['State']);
        $stmtInserts->bindParam(':Zip', $f['Zip']);
        $stmtInserts->bindParam(':PhoneNumber', $f['PhoneNumber']);
        $stmtInserts->bindParam(':Email', $f['Email']);
        $stmtInserts->bindParam(':PetType', $f['PetType']);
        $stmtInserts->bindParam(':Breed', $f['Breed']);
        $stmtInserts->bindParam(':PetName', $f['PetName']);
        $stmtInserts->bindParam(':NeuteredOrSpayed', $f['NeuteredOrSpayed']);
        $stmtInserts->bindParam(':PetBirthday', $f['PetBirthday']);
        if (!$stmtInserts->execute()) {
          logError($stmtInserts->errorInfo()[2]);
          $errors[] = 'Grooming insertion failed. Please try again.';
        }
      } catch (PDOException $e) {
        logError($e);
        $errors[] = 'Grooming insertion failed. Please try again.';
      }

      if (!$errors) { // If there are still no errors
        // show notification message
        //Redirect to grooming get to reset the form
        if(isset($_REQUEST['editId'])){
            header('location:groomings.php?status=ok&msg=The Grooming have been updated  successfully!');
        }else{
            header('location:'.$_SERVER['PHP_SELF'].'?status=ok&msg=The Grooming have been saved successfully!');
        }
      }
    }
  }
?>

<div class="container-fluid">
  <div class="row">
 <?php 
  require 'includes/nav.php';
    ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <?php
        if(isset($_REQUEST['msg']) and $_REQUEST['status']=="ok"){
            echo	'<div class="alert alert-success"><i class="fa fa-exclamation-triangle"></i>'.$_REQUEST['msg'].'!</div>';
        }
    ?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create a New Grooming</h1>
      </div>

    <form id = "groomingFrom"  method="post" action="create.php<?php if(isset($_REQUEST['editId'])) echo "?editId=".$_REQUEST['editId'];?>">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">First Name*</label>
            <input type="firstname" class="form-control" name="FirstName" value="<?= $f['FirstName'] ?>" required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">Last Name*</label>
            <input type="lastname" class="form-control" name="LastName" value="<?= $f['LastName'] ?>" required>
          </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="Email" value="<?= $f['Email'] ?>" require>
            </div>
            <div class="form-group col-md-6">
              <label for="phone">Phone*</label>
              <input type="phone" class="form-control" name="PhoneNumber" value="<?= $f['PhoneNumber'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Address*</label>
            <input type="text" class="form-control" name="Address" value="<?= $f['Address'] ?>" placeholder="" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputCity">City*</label>
              <input type="text" class="form-control" name="City" value="<?= $f['City'] ?>" required>
            </div>
            <div class="form-group col-md-4">
              <label for="inputState">State*</label>
              <input type="text" class="form-control" name="State" value="<?= $f['State'] ?>" required>
              
            </div>
            <div class="form-group col-md-2">
              <label for="inputZip">Zip*</label>
              <input type="text" class="form-control" name="Zip" value="<?= $f['Zip'] ?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="validationTextarea">Message*</label>
            <textarea class="form-control" name="Message" required><?php echo htmlspecialchars($f['Message']); ?></textarea>
            <div class="invalid-feedback">
              Please enter a message in the textarea.
            </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="typeofpet">Type of Pet*
                </label> 
            <select class="form-control" name="PetType" id="PetType" required>
              <option value="1">Cats</option>
              <option value="2">Dogs</option>
              <option value="3">Bird</option>
              <option value="4">Fish</option>
            </select>
          </div>
          
          <div class="form-group col-md-6">
              <label for="typeofpet">Breeds</label>
            <select class="form-control" name="Breed" id="Breed" required>
              <option value="1">Birman</option>
              <option value="1">Balinese</option>
              <option value="1">Bombay</option>
              <option value="2">Bulldog</option>
              <option value="2">Poodle</option>
              <option value="2">German Shepherd</option>
              <option value="3">Cockatiel</option>
              <option value="3">Lovebird</option>
              <option value="4">Guppies<option>
              <option value="4">Mollies<option>
            </select>
          </div>
        </div>
        <div class="form-row">
          
          <div class="form-group col-md-6">
              <label for="petname">Pet's Name*</label>
              <input type="text" class="form-control" name="PetName" value="<?= $f['PetName'] ?>" required>
          </div>
          <div class="form-group col-md-6">
              <label>  Pet's Date of Birth 
              </label>
              <input class="form-control" id="PetBirthday" name="PetBirthday" placeholder="YYYY-MM-DD" type="text"/>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="NeuteredOrSpayed" value="0">
                  <label class="form-check-label" for="inlineCheckbox1">Neutered </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="NeuteredOrSpayed" value="1">
                <label class="form-check-label" for="inlineCheckbox2">Spayed</label>
              </div>
          </div>
        </div>  
        <button name="save" class="btn btn-primary float-right"><?php echo (isset($_REQUEST['editId']) ? "Update" : "Save");?></button>
        </form>

    </main>
  </div>
</div>
</body>
</html>
