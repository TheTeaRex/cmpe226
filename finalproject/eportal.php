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
          //Add analytical results
          //$form = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post">';

          $form ='
          <form action="" method="post" name="search_form" id="search_form"/>
          <fieldset>
               <legend> User input</legend>
               <p>
                    <label> Product Section:</label>
                    <input name="section_name" id="section_name" type="text"/>
               </p>

               <p>
                    <label> Store City:</label>
                    <input name="store_city" id="store_city" type="text"/>
               </p>

               <p>
                    <label> Product Vendor:</label>
                    <input name="product_vendor" id="product_vendor" type="text"/>
               </p>

               <p>
                    <label> Day of Week:</label>
                    <input name="day_of_week" id="day_of_week" type="text"/>
               </p>

               <p>
                    <label> Quarter:</label>
                    <input name="quarter" id="quarter" type="text">
               </p>

               <p>
                    <label> Year </label>
                    <input name="year" id="year" type="text"/>
               </p>

               <p>
                    <input type="submit" name="submit" value="Submit"/>
               </p>

          </fieldset>
     </form>';
     print ($form);
       //Searching Result;

        if (isset($_POST['submit'])) {
        print "<h1> Searching Result!</h1>";
        //get information from user input
        $section_name=$_POST['section_name'];
        $product_vendor=$_POST['product_vendor'];
        $day_of_week=$_POST['day_of_week'];
        $quarter=(int)$_POST['quarter'];
        $year=(int)$_POST['year'];
        $store_city=$_POST['store_city'];

        $page="";

        try{
          //connect to db
          $con = new PDO("mysql:host=localhost;dbname=acid_WH", "acidwh", "seasame");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          //$query="SELECT first, last";
                    $query ="SELECT SUM(ST.UnitsSold) as UnitsSold, P.SectionName, P.ProductVendor, S.StoreCity, C.DayOfWeek,C.Quarter,C.YEAR
                         FROM Calendar_WH C, Store_WH S, Product_WH P, SalesTransaction_WH ST
                         WHERE C.CalendarKey=ST.CalendarKey
                         AND S.StoreKey=ST.StoreKey
                         AND P.ProductKey=ST.ProductKey ";

          //the filter conditions
          $add=" AND ";
                    $query=$query.$add." P.SectionName='$section_name'";
                    $query=$query.$add." P.ProductVendor='$product_vendor'";
                    $query=$query.$add." S.StoreCity='$store_city'";
                    $query=$query.$add." C.DayOfWeek=$day_of_week";
                    $query=$query.$add." C.Quarter=$quarter";
                    $query=$query.$add." C.Year=$year";

          //query db
          $data = $con->query($query);
          $data->setFetchMode(PDO::FETCH_ASSOC);
          if($data->rowCount()>0){

            $num=$data->rowCount();
            print " search result number $num";

            $page = $page."<table border='1'>";
            //header
            $doHeader = true;
            foreach($data as $row){
              if($doHeader){
                $page=$page."<tr>";
                foreach ($row as $name => $value) {
                  $page=$page."<th>$name</th>";
                }
                $page=$page."</tr>";
                $doHeader=false;
              }

            //result
            $page=$page."<tr>";
            foreach ($row as $name => $value) {
              $page = $page."<td>$value</td>";
            }
            $page=$page."</tr>";
          }
          $page=$page."</table>";

          //$page="<h> ".$query."</h1>";

        }else{
            $page="<h> No Record Has Been Found</h1>";
          }

          print $page;
        }
        catch(PDOException $ex){
          echo 'ERROR: ' .$ex->getMessage();
        }

        //$output=$output.$query;

        //print $output;
      }

        //End of adding analytical results
        ?>
      </section>
    </div>
  </div>

  <!--footer-->
  <?php printFooter('customer'); ?>
</body>
</html>
