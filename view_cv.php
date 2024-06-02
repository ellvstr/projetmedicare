<?php
    require_once 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Requête pour récupérer le CV du médecin
        $sql = "SELECT CV FROM medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            header('Content-Type: text/xml');
            echo $row['CV'];
        } else {
            echo "Aucun CV trouvé pour cet ID.";
        }
    } else {
        echo "ID non spécifié.";
    }
?>