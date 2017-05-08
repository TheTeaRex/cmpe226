<?php
  include 'function.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Team ACID CMPE 226 Project</title>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-panels.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel-noscript.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-desktop.css" />
  </noscript>
</head>

<body>

  <!--header-->
    <div id="header">
      <div class="container">
        <div id="logo">
          <h1><a>The Retail Store</a></h1>
          <span class="tag">By Team ACID</span>
        </div>
      </div>
    </div>

  <!--main-->
  <div id="main">
    <div id="content" class="container">
      <section>
        <?php
          $userid = filter_input(INPUT_POST, "userid");
          $pw = filter_input(INPUT_POST, "password");

          $query = "SELECT t.EmployeeID ".
                   "FROM employee as t ".
                   "WHERE t.EmployeeID = :userid ".
                   "AND t.EmployeePassword = :pw";
          $sub = array(':userid' => $userid, ':pw' => $pw);
          try {
            $data = doingPrepareQuery($query, $sub);
            if (empty($data)) {
              header('Location:eerror.php');
            } else {
              print_r($data);
            }
          }
          catch (PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
          }
        ?>
      </section>
    </div>
  </div>

  <!--footer-->
  <div id="footer">
    <div class="container">
      <section>
        <p><a href="index.php">Customer Portal</a></p>
      </section>
    </div>
  </div>
</body>
</html>
