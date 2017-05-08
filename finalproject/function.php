<?php
  function doingPrepareQuery($query, $sub = array()) {
    // connect to the databse
    $con = new PDO("mysql:host=localhost;dbname=acid", "acid", "acid@226");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // querying the database
    $ps = $con->prepare($query);
    if (empty($sub)) {
      $ps->execute();
    }
    else {
      $ps->execute($sub);
    }
    $data = $ps->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  }

  function doingQuery($query) {
    // connect to the databse
      $con = new PDO("mysql:host=localhost;dbname=acid", "acid", "acid@226");
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // querying
      $data = $con->query($query);
      $data->setFetchMode(PDO::FETCH_ASSOC);

    return $data;
  }
?>
