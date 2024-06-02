<?php
session_start();
header('Content-Type: application/json');
require 'config.php';

$userId = $_SESSION['user_id']; // ID du client connecté

$sql = "SELECT rdv.*, med.Nom_M_PS, med.Prenom_M_PS, med.Specialite, labo.Adresse_Labo 
        FROM rendez_vous rdv
        JOIN medecin_et_professionnel_de_sante med ON rdv.ID_Medecin = med.ID_Medecin
        JOIN laboratoire_de_biologie_medicale labo ON rdv.ID_Labo = labo.ID_Labo
        WHERE rdv.ID_Client = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$rendezvous = $stmt->fetchAll();

echo json_encode($rendezvous);
?>
