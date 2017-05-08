<?php
  function printHead() {
    $output = '
  <meta charset="UTF-8">
  <title>Team ACID CMPE 226 Project</title>
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900" rel="stylesheet" type="text/css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-panels.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel-noscript.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-desktop.css" />
  </noscript>
    ';
		print($output);
  }

	function printHeader() {
		$output = '
  <div id="header">
    <div class="container">
      <div id="logo">
        <h1><a>The Retail Store</a></h1>
        <span class="tag">By Team ACID</span>
      </div>
    </div>
  </div>
		';
		print($output);
	};

	function printMain($user, $error=false) {
		$output = '
  <div id="main">
    <div id="content" class="container">
      <section>
        <header>
          <h2>%user% Login:</h2>
        </header>
				%error%
        <form action="%portal%" method="post">
          <p>
            <label>User ID:</label><br>
            <input name="userid" type="text"/>
          </p>
          <p>
            <label>Password:</label><br>
            <input name="password" type="password"/>
          </p>
          <p>
            <input type="submit" value="Enter"/>
          </p>
        </form>
      </section>
    </div>
  </div>
		';
		$output = str_replace("%user%", $user, $output);
		if ($user == "Customer") {
			$output = str_replace("%portal%", "portal.php", $output);
		} else {
			$output = str_replace("%portal%", "eportal.php", $output);
		};
		if (!$error) {
			$output = str_replace("%error%", "", $output);
		} else {
      $sub = '<p><font color="red">* User/Password is not valid</font></p>';
			$output = str_replace("%error%", $sub, $output);
		}
		print($output);
	};

	function printFooter($replacement) {
		$output = '
  <div id="footer">
    <div class="container">
      <section>
      	%replaceMe%
      </section>
    </div>
  </div>
		';
		if ($replacement == 'customer') {
			$sub = '<p><a href="index.php">Customer Portal</a></p>';
		} else {
			$sub = '<p><a href="elogin.php">Employee Portal</a></p>';
		};
		$output = str_replace("%replaceMe%", $sub, $output);
		print($output);
	};
?>
