<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

$client_id = $_SESSION['client_id'];

// Récupérer les messages échangés
$sql = "SELECT * FROM messages WHERE  id_client  = :id_client ORDER BY timestamp DESC" ;
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_client', $client_id);
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Gérer l'envoi d'un nouveau message
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $id_client = $messages['id_client'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (id_client, message) VALUES (:id_client, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_client', $client_id);
    $stmt->bindParam(':message', $message);
    $stmt->execute();

    // Rediriger vers la page de messagerie après l'envoi du message
    header("Location: chat2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messagerie</title>
    <style>
    body {
    background-color: #008080;
    color: white;
    font-family: Arial, sans-serif;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 2px solid #ccc;
    padding-bottom: 20px;
    margin-bottom: 20px;
}

.header-content {
    display: flex;
    align-items: center;
    text-align: center;
}

header h1 {
    margin: 0;
    font-size: 24px;
    color: #3da09a;
}

header .teal {
    color: #3da09a;
}

header .light-teal {
    color: #8dd2c2;
}

header .logo {
    margin-left: 20px;
    height: 50px;
}

nav {
    margin-bottom: 20px;
}

nav ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    justify-content: space-around;
    margin: 0;
}

nav ul li {
    margin: 0 10px;
}

nav ul li a {
    text-decoration: none;
    color: #ffffff;
    background-color: #3da09a;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 16px;
}

nav ul li a:hover {
    background-color: #8dd2c2;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #003333;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1, h2 {
    color: #008080;
    text-align: center;
}

p, a {
    color: #FFFFFF;
}

a {
    text-decoration: none;
    color: #00FFFF;
}

a:hover {
    text-decoration: underline;
}

.rdv {
    background-color: #004D4D;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
}

.wrapper {
    width: 80%;
    max-width: 1200px;
    margin: 0 auto;
    background-color: black;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    box-sizing: border-box;
}

textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

button {
    background-color: #3da09a;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #8dd2c2;
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

    </style>
</head>
<body>
    <h1>Messagerie</h1>
    <div id="messages">
        <?php foreach (array_reverse($messages) as $message): ?>
            <div>
                <strong><?php echo htmlspecialchars($_SESSION['client_name']); ?>:</strong>
                <span><?php echo htmlspecialchars($message['message']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <textarea name="message" placeholder="Entrez votre message ici" required></textarea>
        <select name="medecin">
            <?php
            // Requête SQL pour récupérer les données des médecins
            $sql = "SELECT ID_Medecin, Nom, Prenom, Photo FROM Medecin_et_professionnel_de_sante";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $medecins = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Parcourir les résultats et afficher chaque médecin dans une option de la liste déroulante
            foreach ($medecins as $medecin) {
                echo '<option value="' . $medecin['ID_Medecin'] . '">';
                echo htmlspecialchars($medecin['Nom'] . ' ' . $medecin['Prenom']);
                echo '</option>';
            }
            ?>
        </select>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>

