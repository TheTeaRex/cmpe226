<!DOCTYPE html>
<html lang="en-US">
<head>
  <meta charset="UTF-8">
  <title>Team ACID CMPE 226 Project</title>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700,500,900' rel='stylesheet' type='text/css'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="js/skel.min.js"></script>
  <script src="js/skel-panels.min.js"></script>
  <script src="js/init.js"></script>
  <noscript>
    <link rel="stylesheet" href="css/skel-noscript.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-desktop.css" />
  </noscript>
</head>

<body>

  <!--header-->
  <div id="header">
    <div class="container">
      <div id="logo">
        <h1><a href="#">The Retail Store</a></h1>
        <span class="tag">By Team ACID</span>
      </div>
    </div>
  </div>

  <!--main-->
  <div id="main">
    <div id="content" class="container">
      <section>
        <header>
          <h2>Customer Login:</h2>
            <?php if (!empty($_POST)): ?>
              <p><font color="red">* User/Password is not valid</font></p>
            <?php endif; ?>
        </header>
        <form action="portal.php" method="post">
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

  <!--footer-->
  <div id="footer">
    <div class="container">
      <section>
        <p><a href="elogin.php">Employee Portal</a></p>
      </section>
    </div>
  </div>
</body>
</html>
