<?php
  $pageTitle = 'Grooming List';
  require 'includes/header.php';

  $offset = $_GET['offset'] ?? 0;
  $offset = (int) $offset;
  $rowsToShow = 3;

  $order = $_GET['order'] ?? 'GroomingID';
  
  $dir = $_GET['dir'] ?? 'asc';
  $dirAllowed = ['asc', 'desc'];
  if (!in_array($dir, $dirAllowed)) {
    $dir = 'asc';
  }

  $query = "SELECT * FROM grooming
    ORDER BY $order $dir 
    LIMIT $offset, $rowsToShow"; 

  try {
    $stmt = $db->prepare($query);
    if (!$stmt->execute()) {
      $errorMsg = $stmt->errorInfo()[2] . ": $query";
      logError($errorMsg);
    }
  } catch (PDOException $e) {
    logError($e, true);
  }

  $qgroomingCount = "SELECT COUNT(*) AS num FROM grooming";
  
  try {
    $stmtGroomingCount = $db->prepare($qgroomingCount);
    if (!$stmtGroomingCount->execute()) {
      $errorMsg = $stmtGroomingCount->errorInfo()[2] . ": $query";
      logError($errorMsg); 
    }
  } catch (PDOException $e) {
    logError($e, true); // Redirect to error page
  }
  $groomingsCount = $stmtGroomingCount->fetch()['num'];

  $prevOffset = max($offset - $rowsToShow, 0);
  $nextOffset = $offset + $rowsToShow;

  $href = "groomings.php?";
  $prev = $href . "offset=$prevOffset&order=$order&dir=$dir";
  $next = $href . "offset=$nextOffset&order=$order&dir=$dir";

?>

<div class="container-fluid">
  <div class="row">
 <?php 
  require 'includes/nav.php';
    ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Grooming List</h1>
      </div>
      <a class="btn btn-primary mb-2 float-right" href="create.php" role="button">Add New Grooming</a>
      <table class="table table-sm table-hover">
      <caption>Total Grooming Requests: <?= $groomingsCount ?></caption>
      <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Full Name</th>
      <th scope="col">City</th>
      <th scope="col">Phone #</th>
      <th scope="col">Email</th>
      <th scope="col">Pet Type</th>
      <th scope="col">Actions </th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $count = 0;
        while ($row = $stmt->fetch()) {
            $count ++;
          ?>
    <tr>
          <th scope="row"><?php echo $count;?></th>
         <td><?php echo $row['FirstName'];?></td>
         <td><?php echo $row['City'];?></td>
         <td><?php echo $row['PhoneNumber'];?></td>
         <td><?php echo $row['Email'];?></td>
         <td><?php echo $row['PetType'];?></td>
         <td>
            <a class="p-2" href="create.php?editId=<?php echo $row['GroomingID'];?>"><i class="fa fa-fw fa-edit"></i></a>
            <a class="p-2" href="contact.php"><i class="fa fa-fw fa-trash"></i></a>
        </td>
      </tr>
    <?php 
						}
      ?>
  </tbody>
      </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end">
            <li class="page-item <?php if ($offset === 0) echo "disabled" ?>">
                <a class="page-link" href="<?php echo $prev ?>" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item <?php if ($nextOffset >= $groomingsCount) echo "disabled" ?>">
                <a class="page-link" href="<?php echo $next ?>">Next</a>
            </li>
            </ul>
        </nav>
      
    </main>
  </div>
</div>
<script>

      $(function() {
        var $select1 = $( '#PetType' );
        var		$select2 = $( '#Breed' );
        var   $options = $select2.find( 'option' );
            
        $select1.on( 'change', function() {
          $select2.html( $options.filter( '[value="' + this.value + '"]' ) );
        } ).trigger( 'change' );


        $('#PetBirthday').datepicker({
              uiLibrary: 'bootstrap4',
          });

          $("#groomingFrom").validate();
        });

        
  </script>
</body>
</html>