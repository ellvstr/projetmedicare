<?php
    require_once 'config.php'; // Inclure le fichier de configuration de la base de données
    
    // Vérifier si l'ID du médecin est passé en paramètre dans l'URL
    if(isset($_GET['id'])) {
        // Récupérer l'ID du médecin depuis l'URL
        $medecin_id = $_GET['id'];
        
        // Requête pour sélectionner les informations du médecin
        $sql_medecin = "SELECT Nom_M_PS, Prenom_M_PS, Specialite, E_mail_M_PS, Telephone_M_PS, Photo FROM Medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
        
        // Préparer la requête
        $stmt_medecin = $pdo->prepare($sql_medecin);
        
        // Liaison des paramètres
        $stmt_medecin->bindParam(':id', $medecin_id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt_medecin->execute();
        
        // Récupérer les informations du médecin
        $medecin = $stmt_medecin->fetch(PDO::FETCH_ASSOC);
        
        // Requête pour sélectionner les disponibilités du médecin
        $sql_disponibilites = "SELECT Jour_semaine, Heure FROM disponibilites WHERE ID_Medecin = :id";
        
        // Préparer la requête
        $stmt_disponibilites = $pdo->prepare($sql_disponibilites);
        
        // Liaison des paramètres
        $stmt_disponibilites->bindParam(':id', $medecin_id, PDO::PARAM_INT);
        
        // Exécution de la requête
        $stmt_disponibilites->execute();
        
        // Récupérer les disponibilités du médecin
        $disponibilites = $stmt_disponibilites->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Rediriger si l'ID du médecin n'est pas fourni
        header("Location: index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilités du Médecin</title>
    <!-- Styles CSS et liens vers les bibliothèques -->
</head>
<body>
    <!-- En-tête et navigation -->
    <!-- Contenu principal -->
    <div class="container">
        <h1>Disponibilités du Médecin</h1>
        <div class="profile-info">
            <img src="<?php echo $medecin['Photo']; ?>" alt="Photo du Médecin">
            <p>Nom: <?php echo $medecin['Nom_M_PS']; ?></p>
            <p>Prénom: <?php echo $medecin['Prenom_M_PS']; ?></p>
            <p>Spécialité: <?php echo $medecin['Specialite']; ?></p>
            <p>Email: <?php echo $medecin['E_mail_M_PS']; ?></p>
            <p>Téléphone: <?php echo $medecin['Telephone_M_PS']; ?></p>
        </div>
        <h2>Disponibilités</h2>
        <table>
            <thead>
                <tr>
                    <th>Jour de la semaine</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($disponibilites as $disponibilite): ?>
                    <tr>
                        <td><?php echo $disponibilite['Jour_semaine']; ?></td>
                        <td><?php echo $disponibilite['Heure']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
