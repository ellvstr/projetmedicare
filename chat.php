<?php
session_start();
require_once 'config.php';

if (isset($_GET['logout'])) {
    $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>" . $_SESSION['name'] . "</b> a quitté la session de chat.</span><br></div>";
    file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
    session_destroy();
    header("Location: chat.php");
    exit;
}

if (isset($_POST['enter'])) {
    if ($_POST['name'] != "") {
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
        $_SESSION['user_type'] = $_POST['user_type'];
    } else {
        echo '<span class="error">Veuillez saisir votre nom</span>';
    }
}

function loginForm() {
    echo
    '<div id="loginform">
    <p>Veuillez saisir votre nom pour continuer!</p>
    <form action="chat.php" method="post">
        <label for="name">Nom: </label>
        <input type="text" name="name" id="name" />
        <input type="hidden" name="user_type" value="medecin" /> <!-- Ajout du type d\'utilisateur -->
        <input type="submit" name="enter" id="enter" value="Soumettre" />
    </form>
    </div>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Chatroom</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
if (!isset($_SESSION['name'])) {
    loginForm();
} else {
?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Bienvenue, <b><?php echo $_SESSION['name']; ?></b></p>
        <p class="logout"><a id="exit" href="#">Quitter la conversation</a></p>
    </div>
    <div id="chatbox">
    <?php
    if (file_exists("log.html") && filesize("log.html") > 0) {
        $contents = file_get_contents("log.html"); 
        echo $contents;
    }
    ?>
    </div>
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" />
        <input name="submitmsg" type="submit" id="submitmsg" value="Envoyer" />
    </form>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function () {
    $("#submitmsg").click(function () {
        var clientmsg = $("#usermsg").val();
        $.post("post.php", { text: clientmsg });
        $("#usermsg").val("");
        return false;
    });

    function loadLog() {
        var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement avant la requête
        $.ajax({
            url: "log.html",
            cache: false,
            success: function (html) {
                $("#chatbox").html(html); //Insérez le log de chat dans la #chatbox div
                //Auto-scroll 
                var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Hauteur de défilement apres la requête
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Défilement automatique 
                } 
            }
        });
    }

    setInterval(loadLog, 2500);

    $("#exit").click(function () {
        var exit = confirm("Voulez-vous vraiment mettre fin à la session ?");
        if (exit == true) {
            window.location = "chat.php?logout=true";
        }
    });
});
</script>
</body>
</html>
<?php
}
?>
