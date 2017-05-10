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
          $prequest = filter_input(INPUT_POST, "prequest");

          if (!isset($_COOKIE['cus_id'])) {
            // have not authenicate user yet
            $query = "SELECT t.MemberID, t.FirstName, t.LastName, l.MembershipName, l.MembershipAnnualDiscount ".
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
                $discount = $data[0]['MembershipAnnualDiscount'];
              }
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
          } else {
            // authenicated user already
            $query = "SELECT t.MemberID, t.FirstName, t.LastName, l.MembershipName, l.MembershipAnnualDiscount ".
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
                $discount = $data[0]['MembershipAnnualDiscount'];
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
              <span class="byline">Membership Level: %membership% (%discount%% off always!)</span>
            </header>
          ';
          $output = str_replace('%first%', ucfirst($first), $output);
          $output = str_replace('%last%', ucfirst($last), $output);
          $output = str_replace('%membership%', ucfirst($level), $output);
          $output = str_replace('%discount%', $discount, $output);
          print($output);

          // products purchased before
          $continue = true;
          $query = 'SELECT DISTINCT p.ProductName, p.ProductPrice '.
                   'FROM saleTransaction as t, contains as c, product as p '.
                   'WHERE t.MemberID = :userid '.
                   'AND t.TransactionID = c.TransactionID '.
                   'AND c.ProductID = p.ProductID';
          $sub = array(':userid' => $id);
          try {
            $data = doingPrepareQuery($query, $sub);
            if (empty($data)) {
              $continue = false;
              print("Seems like you haven't made any purchase yet!");
            } else {
              $list = 'You have purchased the following item before.<br>';
              $list .= '<ul style="list-style-type:square">';
              foreach ($data as $row) {
                $temp = '<li>%ProductName% ($%ProductPrice%)</li>';
                foreach($row as $key=>$value) {
                  $temp = str_replace('%'.$key.'%', ucfirst($value), $temp);
                }
                $list .= $temp;
              }
              $list .= '</ul>';
              print($list);
            }
          }
          catch (PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
          }

          // select previous transaction
          // only continue if the member has done a purchase before
          if ($continue) {
            print('<hr />');
            $query = 'SELECT Distinct t.TransactionDate as tdate '.
                     'FROM saleTransaction as t '.
                     'WHERE t.MemberID = :userid '.
                     'ORDER BY t.TransactionDate';
            $sub = array(':userid' => $id);
            try {
              $data = doingPrepareQuery($query, $sub);
              // going to assume there is data at this point, because the person had made purchase before
              $form = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
              $form .= '<p><label>Select a transaction date: </label><br>';
              $form .= '<select name="tdate">';
              foreach ($data as $row) {
                $temp = '<option value=%date%>%date%</option>';
                foreach($row as $key=>$value) {
                  $temp = str_replace('%date%', $value, $temp);
                }
                $form .= $temp;
              }
              $form .= '</select></p>';
              $form .= '<p><input type="hidden" name="prequest" value="tdate"/></p>';
              $form .= '<p><input type="submit" value="Submit"/></p>';
              $form .= '</form>';
              print($form);
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }
            // result
            if ($prequest == 'tdate') {
              $tdate = filter_input(INPUT_POST, "tdate");
              $query = 'SELECT Distinct p.ProductName, p.ProductPrice '.
                       'FROM saleTransaction as t, contains as c, product as p '.
                       'WHERE t.MemberID = :userid '.
                       'AND t.TransactionDate = :tdate '.
                       'AND t.TransactionID = c.TransactionID '.
                       'AND (t.TransactionType = "Online" OR t.TransactionType = "WalkIn")  '.
                       'AND c.ProductID = p.ProductID '.
                       'ORDER BY p.ProductName';
              $sub = array(':userid' => $id, ':tdate' => $tdate);
              try {
                $data = doingPrepareQuery($query, $sub);
                // going to assume there is data at this point, because the person had made purchase before
                $list = 'You have purchased the following item on this date - '.$tdate.'<br>';
                $list .= '<ul style="list-style-type:square">';
                foreach ($data as $row) {
                  $temp = '<li>%ProductName% ($%ProductPrice%)</li>';
                  foreach($row as $key=>$value) {
                    $temp = str_replace('%'.$key.'%', ucfirst($value), $temp);
                  }
                  $list .= $temp;
                }
                $list .= '</ul>';
                print($list);
              }
              catch (PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
              }
            }
          }

          // select transaction in a period
          // only continue if the member has done a purchase before
          if ($continue) {
            print('<hr />');
            $query = 'SELECT Distinct t.TransactionDate as tdate '.
                     'FROM saleTransaction as t '.
                     'WHERE t.MemberID = :userid '.
                     'ORDER BY t.TransactionDate';
            $sub = array(':userid' => $id);
            try {
              $data = doingPrepareQuery($query, $sub);
              // going to assume there is data at this point, because the person had made purchase before
              $form = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';
              $form .= '<p><label>Select a start date: </label><br>';
              $form .= '<select name="stdate">';
              $block = '';
              foreach ($data as $row) {
                $temp = '<option value=%date%>%date%</option>';
                foreach($row as $key=>$value) {
                  $temp = str_replace('%date%', $value, $temp);
                }
                $block .= $temp;
              }
              $form .= $block;
              $form .= '</select></p>';

              $form .= '<p><label>Select a end date: </label><br>';
              $form .= '<select name="etdate">';
              $form .= $block;
              $form .= '</select></p>';
              $form .= '<p><input type="hidden" name="prequest" value="tdates"/></p>';
              $form .= '<p><input type="submit" value="Submit"/></p>';
              $form .= '</form>';
              print($form);
            }
            catch (PDOException $ex) {
              echo 'ERROR: '.$ex->getMessage();
            }

            // result
            if ($prequest == 'tdates') {
              $stdate = filter_input(INPUT_POST, "stdate");
              $etdate = filter_input(INPUT_POST, "etdate");
              if ($etdate < $stdate) {
                $temp = $stdate;
                $stdate = $etdate;
                $etdate = $temp;
              };
              $query = 'SELECT Distinct p.ProductName, p.ProductPrice '.
                       'FROM saleTransaction as t, contains as c, product as p '.
                       'WHERE t.MemberID = :userid '.
                       'AND (t.TransactionDate BETWEEN :stdate AND :etdate) '.
                       'AND t.TransactionID = c.TransactionID '.
                       'AND (t.TransactionType = "Online" OR t.transactionType = "Walkin") '.
                       'AND c.ProductID = p.ProductID '.
                       'ORDER BY p.ProductName';
              $sub = array(':userid' => $id, ':stdate' => $stdate, ':etdate' => $etdate);
              try {
                $data = doingPrepareQuery($query, $sub);
                // going to assume there is data at this point, because the person had made purchase before
                $list = 'You have purchased the following item on between '.$stdate.' - '.$etdate.'<br>';
                $list .= '<ul style="list-style-type:square">';
                foreach ($data as $row) {
                  $temp = '<li>%ProductName% ($%ProductPrice%)</li>';
                  foreach($row as $key=>$value) {
                    $temp = str_replace('%'.$key.'%', ucfirst($value), $temp);
                  }
                  $list .= $temp;
                }
                $list .= '</ul>';
                print($list);
              }
              catch (PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
              }
            }
          }

        ?>
      </section>
    </div>
  </div>

  <!--footer-->
  <?php printFooter('emplopyee'); ?>
</body>
</html>
