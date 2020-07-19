<?php
  /*
    This config file is specific to the development machine.
    The config file on production will have the same
      functions, but they will return different values.
  */

  function getDbConfig() {
    return [
      'dsn' => 'mysql:host=localhost;dbname=pet_shop',
      'un' => 'root',
      'pw' => ''
    ];
  }
?>