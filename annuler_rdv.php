<?php
// annuler_rdv.php
session_start();
header('Content-Type: application/json');
require 'config.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rdvId = $_POST['id_rdv'];
    $userId = $_SESSION['user_id']; // ID du client connecté

    // Vérifier si le rendez-vous appartient au client connecté
    $sql = "SELECT * FROM rendez_vous WHERE ID_Rdv = ? AND ID_Client = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$rdvId, $userId]);
    $rdv = $stmt->fetch();

    if ($rdv) {
        // Annuler le rendez-vous
        $sql = "DELETE FROM rendez_vous WHERE ID_Rdv = ?";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$rdvId])) {
            $response['success'] = true;
            $response['message'] = "Le rendez-vous a été annulé avec succès.";
        } else {
            $response['message'] = "Une erreur est survenue lors de l'annulation du rendez-vous.";
        }
    } else {
        $response['message'] = "Rendez-vous non trouvé ou vous n'êtes pas autorisé à annuler ce rendez-vous.";
    }
} else {
    $response['message'] = "Requête invalide.";
}

echo json_encode($response);
?>
