<?php
// Inclusion du fichier de configuration de la base de données
require_once 'config.php';

// Vérification si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Requête SQL pour vérifier l'utilisateur dans les différentes tables
    $stmtAdmin = $pdo->prepare("SELECT * FROM Administrateur WHERE Courriel_Admin = ?");
    $stmtMedecin = $pdo->prepare("SELECT * FROM Medecin_et_professionnel_de_sante WHERE E_mail_M_PS = ?");
    $stmtClient = $pdo->prepare("SELECT * FROM Client WHERE E_mail_Client = ?");

    // Exécution des requêtes avec les données fournies
    $stmtAdmin->execute([$username]);
    $stmtMedecin->execute([$username]);
    $stmtClient->execute([$username]);

    // Vérification du résultat
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);
    $medecin = $stmtMedecin->fetch(PDO::FETCH_ASSOC);
    $client = $stmtClient->fetch(PDO::FETCH_ASSOC);

    

    if ($admin && password_verify($password, $admin['Mdp_Admin'])) {
        // Redirection vers le tableau de bord de l'administrateur
        header('Location: dashboard_admin.html');
        exit;
    } elseif ($medecin && password_verify($password, $medecin['Mdp_M_PS'])) {
        // Redirection vers le tableau de bord du médecin ou professionnel de santé
        header('Location: dashboard_medecin.html');
        exit;
    } elseif ($client && password_verify($password, $client['Mdp_Client'])) {
        // Redirection vers le tableau de bord du client
        header('Location: dashboard_client.html');
        exit;
    } else {
        // Identifiants invalides, rediriger vers la page d'erreur
        echo 'Adresse mail ou Mot de passe incorrect';
        exit;
    }
}
?>