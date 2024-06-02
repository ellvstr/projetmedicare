<?php
include 'db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_SESSION['client_id'];
    $type_carte = $_POST['Type_carte'];
    $numero_carte = $_POST['Numero_carte'];
    $nom_proprietaire = $_POST['Nom_proprietaire'];
    $date_expiration = $_POST['Date_expiration'];
    $code_securite = $_POST['Code_securite'];

    $sql = "INSERT INTO Carte_credit (Numero_carte, Type_carte, Nom_proprietaire, Date_expiration, Code_securite, ID_Client)
            VALUES (:numero_carte, :type_carte, :nom_proprietaire, :date_expiration, :code_securite, :client_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numero_carte', $numero_carte);
    $stmt->bindParam(':type_carte', $type_carte);
    $stmt->bindParam(':nom_proprietaire', $nom_proprietaire);
    $stmt->bindParam(':date_expiration', $date_expiration);
    $stmt->bindParam(':code_securite', $code_securite);
    $stmt->bindParam(':client_id', $client_id);

    if ($stmt->execute()) {
        header("Location: paiement_reussi.html");
    } else {
        echo "Erreur lors du paiement";
    }
}

?>
