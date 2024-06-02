<?php
require_once 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Début de la transaction
        $pdo->beginTransaction();

        // Suppression des enregistrements dans disponibilites
        $sql = "DELETE FROM disponibilites WHERE ID_Medecin = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Suppression dans medecin_et_professionnel_de_sante
        $sql = "DELETE FROM medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Validation de la transaction
        $pdo->commit();

        if ($stmt->rowCount() > 0) {
            echo 'success';
        } else {
            echo 'error: no rows affected';
        }
    } catch (Exception $e) {
        // Annulation de la transaction en cas d'erreur
        $pdo->rollBack();
        echo 'error: ' . $e->getMessage();
    }
    exit;
} else {
    echo 'error: No ID provided';
    exit;
}
?>