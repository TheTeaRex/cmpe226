<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="UTF-8">
    <title>Queries</title>
  </head>
  <body>
    <p>
      <?php
		function doingQuery($query, $class, $sub = array()) {
		  print("<p><b>Query done:</b> ".$query."</p>");
		  // connect to the databse
          $con = new PDO("mysql:host=localhost;dbname=acid", "acid", "sesame");
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // querying the database
          $ps = $con->prepare($query);
		  if (empty($sub)) {
		    $ps->execute();
		  }
		  else {
			$ps->execute($sub);
		  }
          $ps->setFetchMode(PDO::FETCH_CLASS, "$class");
		  
		  return $ps;
		}
		
		class Teacher {
		  private $TeacherID;
		  private $PhoneNum;
		  private $FirstName;
		  private $LastName;
		  
		  public function getId() {return $this->TeacherID;}
		  public function getPhone() {return $this->PhoneNum;}
		  public function getFirst() {return $this->FirstName;}
		  public function getLast() {return $this->LastName;}
		}
		
		function createTeacherTableRow(Teacher $t, &$page) {
		  $page = $page . "<tr>";
		  $page = $page . "<td>" . $t->getId() . "</td>";
		  $page = $page . "<td>" . $t->getPhone() . "</td>";
		  $page = $page . "<td>" . $t->getFirst() . "</td>";
		  $page = $page . "<td>" . $t->getLast() . "</td>";
		  $page = $page . "</tr>";
		}
		
		class TeacherInfo {
		  private $PosID;
		  private $PosName;
		  private $FirstName;
		  private $LastName;
		  private $Email;
		  
		  public function getId() {return $this->PosID;}
		  public function getPosName() {return $this->PosName;}
		  public function getFirst() {return $this->FirstName;}
		  public function getLast() {return $this->LastName;}
		  public function getEmail() {return $this->Email;}
		}
		
		function createTeacherInfoTableRow(TeacherInfo $t, &$page) {
		  $page = $page . "<tr>";
		  $page = $page . "<td>" . $t->getId() . "</td>";
		  $page = $page . "<td>" . $t->getPosName() . "</td>";
		  $page = $page . "<td>" . $t->getFirst() . "</td>";
		  $page = $page . "<td>" . $t->getLast() . "</td>";
		  $page = $page . "<td>" . $t->getEmail() . "</td>";
		  $page = $page . "</tr>";
		}

		class Dept {
		  private $DeptID;
		  private $StuID;
		  private $TeacherID;
		  
		  public function getId() {return $this->DeptID;}
		  public function getStuId() {return $this->StuID;}
		  public function getTeacherId() {return $this->TeacherID;}
		}
		
		function createDeptTableRow(Dept $t, &$page) {
		  $page = $page . "<tr>";
		  $page = $page . "<td>" . $t->getId() . "</td>";
		  $page = $page . "<td>" . $t->getStuId() . "</td>";
		  $page = $page . "<td>" . $t->getTeacherId() . "</td>";
		  $page = $page . "</tr>";
		}		
		
		class cls {
		  private $ClassID;
		  private $ClassName;
		  private $FirstName;
		  private $LastName;
		  
		  public function getId() {return $this->ClassID;}
		  public function getName() {return $this->ClassName;}
		  public function getFirst() {return $this->FirstName;}
		  public function getLast() {return $this->LastName;}
		}
		
		function createClassTableRow(Cls $t, &$page) {
		  $page = $page . "<tr>";
		  $page = $page . "<td>" . $t->getId() . "</td>";
		  $page = $page . "<td>" . $t->getName() . "</td>";
		  $page = $page . "<td>" . $t->getFirst() . "</td>";
		  $page = $page . "<td>" . $t->getLast() . "</td>";
		  $page = $page . "</tr>";
		}
		
		try {
		  $first = filter_input(INPUT_POST, "first");
          $last = filter_input(INPUT_POST, "last");
		  $query = "SELECT tp.TeacherID, tp.PhoneNum, t.FirstName, t.LastName ".
				   "FROM teacher_phonenum as tp, teacher as t ".
				   "WHERE tp.TeacherID = t.TeacherID ".
				   "AND (t.FirstName = :first ".
				   "OR t.LastName = :last) ".
				   "ORDER BY tp.TeacherID";
		  $sub = array(':first' => $first, ':last' => $last);
		  $ps = doingQuery($query, "Teacher", $sub);
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>TeacherID</th>" . "<th>PhoneNum</th>" . "<th>FirstName</th>" . "<th>LastName</th>" . "</tr>";
		  while ($teacher = $ps->fetch()) {
		    createTeacherTableRow($teacher, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
		  
				   
		  print ("<p>---------------------------Join Queries as PDO prepared statements-------------------------------</p>");
          $query = "SELECT tp.TeacherID, tp.PhoneNum, t.FirstName, t.LastName ".
		  		 "FROM teacher_phonenum as tp, teacher as t ".
		  		 "WHERE tp.TeacherID = t.TeacherID ".
		  		 "ORDER BY tp.TeacherID";
		  $ps = doingQuery($query, "Teacher");
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>TeacherID</th>" . "<th>PhoneNum</th>" . "<th>FirstName</th>" . "<th>LastName</th>" . "</tr>";
		  while ($teacher = $ps->fetch()) {
		    createTeacherTableRow($teacher, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
		  
		  $query = "SELECT p.PosID, p.PosName, s.FirstName, s.LastName, s.Email ".
		  		 "FROM Student as s,  Position as p ".
		  		 "WHERE s.PosID = p.PosID ".
		  		 "ORDER BY p.PosID DESC, s.LastName";
		  $ps = doingQuery($query, "TeacherInfo");
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>PosID</th>" . "<th>PosName</th>" . "<th>FirstName</th>" . "<th>LastName</th>" . "<th>Email</th>" . "</tr>";
		  while ($teacher = $ps->fetch()) {
		    createTeacherInfoTableRow($teacher, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
		  
         $query = "SELECT tp.TeacherID, tp.PhoneNum, t.FirstName, t.LastName ".
		  		 "FROM teacher_phonenum as tp, teacher as t ".
		  		 "WHERE tp.TeacherID = t.TeacherID ".
		  		 "ORDER BY tp.TeacherID";
		  $ps = doingQuery($query, "Teacher");
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>TeacherID</th>" . "<th>PhoneNum</th>" . "<th>FirstName</th>" . "<th>LastName</th>" . "</tr>";
		  while ($teacher = $ps->fetch()) {
		    createTeacherTableRow($teacher, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
		  
		  $query = "SELECT d.DeptID, s.StuID, t.TeacherID ".
		  		 "FROM Student as s,  Deparment as d, teacher as t ".
		  		 "WHERE s.DeptID = d.DeptID AND d.DeptID = t.DeptID";
		  $ps = doingQuery($query, "Dept");
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>DeptID</th>" . "<th>StuID</th>" . "<th>TeacherID</th>" . "</tr>";
		  while ($dept = $ps->fetch()) {
		    createDeptTableRow($dept, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
		  
		  $query = "SELECT c.ClassID, c.ClassName, s.FirstName, s.LastName ".
		  		 "FROM Class as c, Student as s, enrolls as e ".
		  		 "WHERE s.StuID = e.StuID AND e.ClassID = c.ClassID";
		  $ps = doingQuery($query, "Cls");
		  $page = "<table border=1>";
		  $page = $page . "<tr>" . "<th>ClassID</th>" . "<th>ClassName</th>" . "<th>FirstName</th>" . "<th>LastName</th>" . "</tr>";
		  while ($class = $ps->fetch()) {
		    createClassTableRow($class, $page);
		  }
		  $page = $page . "</table>";
		  print $page;
         }
        catch (PDOException $ex) {
          echo 'ERROR: '.$ex->getMessage();
        }
      ?>
    </p>
  </body>
</html>