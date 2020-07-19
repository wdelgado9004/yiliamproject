<?php
  require 'includes/header.php';

  ?>




<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Grooming</h1>
 
</div>

<div class="container">
    <form id = "groomingFrom">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="firstname">First Name*</label>
            <input type="firstname" class="form-control" id="firstname"required>
          </div>
          <div class="form-group col-md-6">
            <label for="lastname">Last Name*</label>
            <input type="lastname" class="form-control" id="lastname"required>
          </div>
        </div>
        
        <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group col-md-6">
              <label for="phone">Phone*</label>
              <input type="phone" class="form-control" id="phone"required>
            </div>
        
           
    
          </div>
            <div class="form-group">
                <label for="inputAddress">Address*</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"required>
            </div>
              
            <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputCity">City*</label>
                  <input type="text" class="form-control" id="inputCity"required>
                </div>
                <div class="form-group col-md-4">
                  <label for="inputState">State*</label>
                  <input type="text" class="form-control" id="state"required>
                  
                </div>
                <div class="form-group col-md-2">
                  <label for="inputZip">Zip*</label>
                  <input type="text" class="form-control" id="inputZip"required>
                </div>
              </div>
          <div class="mb-3">
              <label for="validationTextarea">Message*</label>
              <textarea class="form-control" id="validationTextarea"  required></textarea>
              <div class="invalid-feedback">
                Please enter a message in the textarea.
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                  <label for="typeofpet">Type of Pet*</label>
              <select class="form-control" name="select1" id="select1"required>
                <option value="1">Cats</option>
                <option value="2">Dogs</option>
                <option value="3">Bird</option>
                <option value="4">Fish</option>
              </select>
            </div>
           
            <div class="form-group col-md-6">
                <label for="typeofpet">Breeds</label>
              <select class="form-control" name="select2" id="select2"required>
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
                <input type="text" class="form-control" id="petname"required>
              </div>
              <div class="control-label col-md-6  for="date" >
                <label>  Pet's Date of Birth 
             
                </label>
              
                 <div class="input-group">
                  <div class="input-group-addon">
                   
                  </div>
                  <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
                 </div>
               
               </div>

          </div>
          <div class="form-row">
  
              <div class="form-check form-check-inline"></div>
              <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                  <label class="form-check-label" for="inlineCheckbox1">Neutered </label>
                </div>
                <div class="form-check form-check-inline"></div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                  <label class="form-check-label" for="inlineCheckbox2">Spayed</label>
                </div>
            </div>
        </div>
       
        <button type="submit" class="btn btn-primary">Sign in</button>
      </form>
    
  </div>

  <?php
  require 'includes/footer.php';

  ?>

  <script>

      $(function() {
        var $select1 = $( '#select1' );
      var		$select2 = $( '#select2' );
      var   $options = $select2.find( 'option' );
          
      $select1.on( 'change', function() {
        $select2.html( $options.filter( '[value="' + this.value + '"]' ) );
      } ).trigger( 'change' );


      $('#date').datepicker({
            uiLibrary: 'bootstrap4'
        });
      });

      $("#groomingFrom").validate();
      
  </script>
</body>
</html>
