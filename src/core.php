<?php
session_start();

function loginForm() {
  echo('
    <div class="login-form">
      <span class="logo">Chatter</span>
      <p>Enter your name</p>
      <form action="index.php" method="POST">
        <input type="text" name="name" id="name">
        <input type="submit" name="login" id="login" value="Login">
      </form>
    </div>
  ');
}

if(isset($_GET['logout'])) {
  $logout_message = '<div class="msgln"><span class="info">User <span class="username-left">' . $_SESSION['name'] . '</span> has left the chat.</span><br></div>';

  file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);

  session_destroy();

  header('Location: index.php');
}

if(isset($_POST['login'])) {
  if(!empty($_POST['name'])) {
    $_SESSION['name'] = htmlentities($_POST['name']);

    $login_message = '<div class="msgln"><span class="info">User <span class="username-left">' . $_SESSION['name'] . '</span> has joined the chat.</span><br></div>';

    file_put_contents("log.html", $login_message, FILE_APPEND | LOCK_EX);
    
    header('Location: index.php');
  }
}