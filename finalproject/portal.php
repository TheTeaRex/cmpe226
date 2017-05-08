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
	<?php printHeader();?>

  <!--main-->
  <div id="main">
    <div id="content" class="container">
      <section>
        <?php
          $userid = filter_input(INPUT_POST, "userid");
          $pw = filter_input(INPUT_POST, "password");

          $query = "SELECT t.MemberID ".
                   "FROM member as t ".
                   "WHERE t.MemberID = :userid ".
                   "AND t.MemberPassword = :pw";
          $sub = array(':userid' => $userid, ':pw' => $pw);
          try {
            $data = doingPrepareQuery($query, $sub);
            if (empty($data)) {
              header('Location:error.php');
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
  <?php printFooter('emplopyee'); ?>
</body>
</html>
