<?php
  include 'function.php';
  clearCookie('cus_id');
  include 'template.php';
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
	<?php printHead(); ?>
</head>

<body>
  <!--header-->
	<?php	printHeader(); ?>

  <!--main-->
  <?php
    $failed = filter_input(INPUT_GET, 'ls');
    printMain("Customer", $failed);
  ?>

  <!--footer-->
	<?php 	printFooter('employee'); ?>
</body>
</html>
