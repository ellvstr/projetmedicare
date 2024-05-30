<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['Nom_Utilisateur_Client'];
    $mot_de_passe = password_hash($_POST['Mot_de_passe_Client'], PASSWORD_DEFAULT);
    $nom = $_POST['Nom_Client'];
    $prenom = $_POST['Prenom_Client'];
    $sexe = $_POST['Sexe'];
    $adresse = $_POST['Adresse'];
    $etat_de_sante = $_POST['Etat_de_sante'];
    $ville = $_POST['Ville'];
    $code_postal = $_POST['Code_Postal'];
    $pays = $_POST['Pays'];
    $telephone = $_POST['Telephone_Client'];
    $carte_vitale = $_POST['Carte_Vitale'];
    $email = $_POST['E_mail_Client'];

    $sql = "INSERT INTO Client (Nom_Utilisateur_Client, Mot_de_passe_Client, Nom_Client, Prenom_Client, Sexe, Adresse, Etat_de_sante, Ville, Code_Postal, Pays, Telephone_Client, Carte_Vitale, E_mail_Client)
            VALUES (:nom_utilisateur, :mot_de_passe, :nom, :prenom, :sexe, :adresse, :etat_de_sante, :ville, :code_postal, :pays, :telephone, :carte_vitale, :email)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_utilisateur', $nom_utilisateur);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':etat_de_sante', $etat_de_sante);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':code_postal', $code_postal);
    $stmt->bindParam(':pays', $pays);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':carte_vitale', $carte_vitale);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo "Inscription réussie";
    } else {
        echo "Erreur lors de l'inscription";
    }
}
?>
