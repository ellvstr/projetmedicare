<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "rdvmedicare";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointment_id = $_POST['id'];

    $sql = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_id);
    if ($stmt->execute()) {
        echo "Le rendez-vous a été annulé avec succès.";
    } else {
        echo "Erreur lors de l'annulation du rendez-vous.";
    }
}

$conn->close();
?>
