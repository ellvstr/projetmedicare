<?php
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$id_medecin = $data['id'];
$disponibilites = $data['disponibilites'];

try {
    $pdo->beginTransaction();

    foreach ($disponibilites as $key => $statut) {
        list($jour, $creneau) = explode('_', $key);
        $sql_update = "UPDATE disponibilites SET Statut = :statut WHERE ID_Medecin = :id AND Jour_semaine = :jour AND Horaire = :creneau";
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->bindParam(':statut', $statut, PDO::PARAM_STR);
        $stmt_update->bindParam(':id', $id_medecin, PDO::PARAM_INT);
        $stmt_update->bindParam(':jour', $jour, PDO::PARAM_STR);
        $stmt_update->bindParam(':creneau', $creneau, PDO::PARAM_STR);

        // Execute the update statement and check if it was successful
        if ($stmt_update->execute()) {
            echo json_encode(['success' => true]);
        } else {
            $error = $stmt_update->errorInfo();
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour: ' . $error[2]]);
        }
    }

    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>