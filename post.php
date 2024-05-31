<?php
session_start();
include 'config.php';

if (isset($_SESSION['name'])) {
    $text = $_POST['text'];
    $user_type = $_SESSION['user_type'];
    
    $formatted_message = "<div class='msgln'><span class='user-name'>$user_type <b>" . $_SESSION['name'] . "</b>:</span> " . stripslashes(htmlspecialchars($text)) . "<br></div>";
    file_put_contents("log.html", $formatted_message, FILE_APPEND | LOCK_EX);
}
?>
