<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Text Greeting</title>
  </head>
  <body>
    <p>
      <?php
        $first = filter_input(INPUT_POST, "first");
        $last = filter_input(INPUT_POST, "last");
        $border = filter_input(INPUT_POST, "border");
        $format = filter_input(INPUT_POST, "format");
        $id = filter_has_var(INPUT_POST, "id");
        $gender = filter_has_var(INPUT_POST, "gender");
        $age = filter_has_var(INPUT_POST, "age");
        $city_born = filter_has_var(INPUT_POST, "city_born");
        $salary = filter_has_var(INPUT_POST, "salary");
        $email = filter_has_var(INPUT_POST, "email");
        $college = filter_has_var(INPUT_POST, "college");

        try {
          // connect to the databse
          $con = new PDO("mysql:host=localhost;dbname=acid", "acid", "sesame");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $query = "select first, last ";
          if ($id) $query = $query.",id ";
          if ($gender) $query = $query.",gender ";
          if ($age) $query = $query.",age ";
          if ($city_born) $query = $query.",city_born ";
          if ($salary) $query = $query.",salary ";
          if ($email) $query = $query.",email ";
          if ($college) $query = $query.",college ";

          // if we didn't get any name
          if ((strlen($first) == 0) && (strlen($last) == 0)) {
            $query = $query."from people";
            $page = "<h1>Information on Everyone!</h1>";
          } else {
            $query = $query."from people where ";
            if ((strlen($first) > 0) && (strlen($last) > 0)) {
              // have both first and last name
              $query = $query."first = '$first' and last = '$last'";
            } elseif (strlen($first) > 0) {
              // have only first name
              $query = $query."first = '$first'";
            } else {
              // have only last name
              $query = $query."last = '$last'";
            }

            $page = "<h1>Information on ";
            switch ($format) {
              case "firstlast":
                $person = "$first $last";
                break;
              case "firstonly":
                $person = "$first";
                break;
              case "lastonly":
                $person ="$last";
                break;
            }
            $page = $page.$person."</h1>";
          }

          // querying the database
          $data = $con->query($query);
          $data->setFetchMode(PDO::FETCH_ASSOC);

          if ($data->rowCount() > 0) {
            // table border
            $page = $page."<table border='$border'>";

            // do header once
            $doHeader = true;
            foreach($data as $row) {
              if ($doHeader) {
                $page = $page."<tr>";
                foreach ($row as $name => $value) {
                  $page = $page."<th>$name</th>";
                }
                $page = $page."</tr>";
                $doHeader = false;
              }
              $page = $page."<tr>";
              foreach ($row as $name => $value) {
                if ($name == "salary") $page = $page."<td>$$value</td>";
                else $page = $page."<td>$value</td>";
              }
              $page = $page."</tr>";
            }
            $page = $page."</table>";
          } else {
            $page = "<h1>$person is not found in database</h1>";
          }

          print $page;
        }
        catch (PDOException $ex) {
          echo 'ERROR: '.$ex->getMessage();
        }
      ?>
    </p>
  </body>
</html>
