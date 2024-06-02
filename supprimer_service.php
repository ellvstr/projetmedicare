<?php
require_once 'config.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Début de la transaction
        $pdo->beginTransaction();

        // Suppression dans services
        $sql = "DELETE FROM services WHERE ID_Services = :id";
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