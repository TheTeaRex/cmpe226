<?php
  include 'function.php';
  include 'template.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php printHead(); ?>
</head>

<body>

  <!--header-->
  <?php printHeader(); ?>

  <!--main-->
  <div id="main">
    <div id="content" class="container">
      <section>
        <?php
          $userid = filter_input(INPUT_POST, "userid");
          $pw = filter_input(INPUT_POST, "password");

          if (!isset($_COOKIE['emp_id'])) {
            // have not authenicate user yet
            $query = "SELECT t.EmployeeID, t.EmployeeFirstName as FirstName, t.EmployeeLastName as LastName ".
                     "FROM employee as t ".
                     "WHERE t.EmployeeID = :userid ".
                     "AND t.password = :pw";
            $sub = array(':userid' => $userid, ':pw' => $pw);
            try {
              $data = doingPrepareQuery($query, $sub);
              if (empty($data)) {
                header('Location:elogin.php?ls=1');
              } else {
                setPageCookie('emp_id', $data[0]['EmployeeID']);
                $id = $data[0]['EmployeeID'];
                $first = $data[0]['FirstName'];
                $last = $data[0]['LastName'];
              }
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
          } else {
            // authenicated user already
            $query = "SELECT t.EmployeeID, t.EmployeeFirstName as FirstName, t.EmployeeLastName as LastName ".
                     "FROM employee as t ".
                     "WHERE t.EmployeeID = :userid";
            $sub = array(':userid' => $_COOKIE['emp_id']);
            try {
              $data = doingPrepareQuery($query, $sub);
              if (empty($data)) {
                header('Location:elogin.php?ls=1');
              } else {
                $id = $_COOKIE['emp_id'];
                $first = $data[0]['FirstName'];
                $last = $data[0]['LastName'];
              }
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
          }

          // everything should come after this line
          // can access employee id with $id
          $output = '
            <header>
              <h2>Welcome %first% %last%!</h2>
            </header>
          ';
          $output = str_replace('%first%', $first, $output);
          $output = str_replace('%last%', $last, $output);
          print($output);
        ?>
      </section>
    </div>
  </div>

  <!--footer-->
  <?php printFooter('customer'); ?>
</body>
</html>
