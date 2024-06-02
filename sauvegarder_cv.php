<?php
// Inclusion du fichier de configuration de la base de données
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_medecin = $_POST['id_medecin'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $competences = $_POST['competences'];
    $loisirs = $_POST['loisirs'];
    $experiences = $_POST['experiences'];
    $formations = $_POST['formations'];

    // Créer un document XML avec les données
    $xml = new SimpleXMLElement('<cv></cv>');
    $xml->addChild('nom', $nom);
    $xml->addChild('prenom', $prenom);
    $xml->addChild('email', $email);
    $xml->addChild('telephone', $telephone);
    $xml->addChild('competences', $competences);
    $xml->addChild('loisirs', $loisirs);
    $xml->addChild('experiences', $experiences);
    $xml->addChild('formations', $formations);

    // Enregistrer le document XML dans une chaîne
    $xml_string = $xml->asXML();

    // Préparer la requête pour mettre à jour la base de données
    $sql = "UPDATE medecin_et_professionnel_de_sante SET cv = :cv WHERE ID_Medecin = :id_medecin";
    $stmt = $pdo->prepare($sql);

    // Lier les paramètres
    $stmt->bindParam(':cv', $xml_string, PDO::PARAM_LOB);
    $stmt->bindParam(':id_medecin', $id_medecin, PDO::PARAM_INT);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Le CV a été enregistré avec succès.";
    } else {
        echo "Erreur lors de l'enregistrement du CV.";
    }
}
?>