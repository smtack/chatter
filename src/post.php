<?php
session_start();

if(isset($_SESSION['name'])) {
  if(!empty($_POST['text'])) {
    $text = $_POST['text'];

    $message = '<div class="msgln"><span class="chat-time">' . date('G:i:s') . '</span><span class="username">' . $_SESSION['name'] . '</span>' . stripslashes(htmlspecialchars($text)) . "</br></div>\n";
  
    file_put_contents("../log.html", $message, FILE_APPEND | LOCK_EX);
  }
}