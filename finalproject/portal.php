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

          if (!isset($_COOKIE['cus_id'])) {
            // have not authenicate user yet
            $query = "SELECT t.MemberID, t.FirstName, t.LastName, l.MembershipName ".
                     "FROM member as t, membership as l ".
                     "WHERE t.MemberID = :userid ".
                     "AND t.password = :pw ".
                     "AND l.MembershipID = t.MembershipID";
            $sub = array(':userid' => $userid, ':pw' => $pw);
            try {
              $data = doingPrepareQuery($query, $sub);
              if (empty($data)) {
                header('Location:index.php?ls=1');
              } else {
                setPageCookie('cus_id', $data[0]['MemberID']);
                $id = $data[0]['MemberID'];
                $first = $data[0]['FirstName'];
                $last = $data[0]['LastName'];
                $level = $data[0]['MembershipName'];
              }
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
          } else {
            // authenicated user already
            $query = "SELECT t.MemberID, t.FirstName, t.LastName, l.MembershipName ".
                     "FROM member as t, membership as l ".
                     "WHERE t.MemberID = :userid ".
                     "AND l.MembershipID = t.MembershipID";
            $sub = array(':userid' => $_COOKIE['cus_id']);
            try {
              $data = doingPrepareQuery($query, $sub);
              if (empty($data)) {
                header('Location:index.php?ls=1');
              } else {
                $id = $_COOKIE['cus_id'];
                $first = $data[0]['FirstName'];
                $last = $data[0]['LastName'];
                $level = $data[0]['MembershipName'];
              }
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
          }

          // everything should come after this line
          // can access member id with $id
          $output = '
            <header>
              <h2>Welcome %first% %last%!</h2>
              <span class="byline">Membership Level: %membership%</span>
            </header>
          ';
          $output = str_replace('%first%', ucfirst($first), $output);
          $output = str_replace('%last%', ucfirst($last), $output);
          $output = str_replace('%membership%', ucfirst($level), $output);
          print($output);
        ?>
      </section>
    </div>
  </div>

  <!--footer-->
  <?php printFooter('emplopyee'); ?>
</body>
</html>
