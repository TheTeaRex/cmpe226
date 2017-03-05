<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Queries</title>
  </head>
  <body>
    <p>
      <?php
		function doingQuery($query) {
		  print("<p><b>Query done:</b> ".$query."</p>");
		  // connect to the databse
          $con = new PDO("mysql:host=localhost;dbname=acid", "acid", "sesame");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // querying the database
          $ps = $con->prepare($query);
		  $ps->execute();
          $data = $ps->fetchAll(PDO::FETCH_ASSOC);
		  
		  return $data;
		}
		
		function parsingData($data) {
		  if (!empty($data)) {
            // table border
            $page = "<table border='1'>";

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
            $page = "No Data was return from the database";
          }
		  return $page;
		}
		
        try {
          $array = array ("SELECT tp.TeacherID, tp.PhoneNum, t.FirstName, t.LastName ".
						  "FROM teacher_phonenum as tp, teacher as t ".
						  "WHERE tp.TeacherID = t.TeacherID ".
						  "ORDER BY tp.TeacherID");
		  array_push ($array, "SELECT p.PosID, p.PosName, s.FirstName, s.LastName, s.Email ".
							  "FROM Student as s,  Position as p ".
							  "WHERE s.PosID = p.PosID ".
							  "ORDER BY p.PosID DESC, s.LastName");
		  array_push ($array, "SELECT d.DeptName, AVG(t.Age) ".
							  "FROM Deparment as d, teacher as t ".
							  "WHERE d.DeptID = t.DeptID ".
							  "GROUP BY d.DeptID");
		  array_push ($array, "SELECT d.DeptName, AVG(t.Age), AVG(s.Age) ".
							  "FROM Deparment as d, teacher as t, Student as s ".
							  "WHERE d.DeptID = t.DeptID AND t.DeptID = s.DeptID ".
							  "GROUP BY d.DeptID ".
							  "HAVING AVG(t.Age) < 50 AND AVG(s.Age) > 20");
		  array_push ($array, "SELECT d.DeptID, s.StuID, t.TeacherID ".
							  "FROM Student as s,  Deparment as d, teacher as t ".
							  "WHERE s.DeptID = d.DeptID AND d.DeptID = t.DeptID");
		  array_push ($array, "SELECT c.ClassID, c.ClassName, s.FirstName, s.LastName ".
							  "FROM Class as c, Student as s, enrolls as e ".
							  "WHERE s.StuID = e.StuID AND e.ClassID = c.ClassID");
		  
		  foreach ($array as $item) {
			$data = doingQuery($item);
			$page = parsingData($data);
		  
			print $page;
		  }
        }
        catch (PDOException $ex) {
          echo 'ERROR: '.$ex->getMessage();
        }
      ?>
    </p>
  </body>
</html>
