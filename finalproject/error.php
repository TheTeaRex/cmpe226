<?php include 'template.php'; ?>

<!DOCTYPE html>
<html lang="en-US">
<head>
  <?php printHead(); ?>
</head>

<body>
  <!--header-->
  <?php printHeader(); ?>

  <!--main-->
  <?php printMain("Customer", true); ?>

  <!--footer-->
  <?php printFooter('employee'); ?>
</body>
</html>
