<?php
  include 'function.php';
  clearCookie('emp_id');
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
  <?php
    $failed = filter_input(INPUT_GET, 'ls');
    printMain("Employee", $failed);
  ?>

  <!--footer-->
  <?php printFooter('customer'); ?>
</body>
</html>
