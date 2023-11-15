<?php require_once 'src/core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <title>Chatter</title>
</head>
<body>
  <?php if(!isset($_SESSION['name'])): ?>
    <?php loginForm(); ?>
  <?php else: ?>
    <div class="container">
      <div class="menu">
        <span class="logo">Chatter</span>
        <p id="welcome">Welcome to chatter, <span class="username"><?=$_SESSION['name']?></span></p>
        <p id="logout"><a id="exit" href="#">Log Out</a></p>
      </div>

      <div class="chatbox">
      </div>

      <div class="form">
        <form name="message">
          <input name="usrmsg" id="usrmsg" type="text">
          <input name="submit" id="submit" type="submit">
        </form>
      </div>
    </div>
  <?php endif; ?>
</body>
</html>