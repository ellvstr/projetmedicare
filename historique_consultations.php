<?php

include 'db_connection.php';
session_start();

if (!isset($_SESSION['ID_Client'])) {
    header('Location: login.html');
    exit();
}

$id_client = $_SESSION['ID_Client'];

$sql = "SELECT rdv.Date_heure, rdv.Statut, med.Nom, med.Prenom, med.Specialite
        FROM Rendez_vous rdv
        JOIN Medecin_et_professionnel_de_sante med ON rdv.ID_Medecin = med.ID_Medecin
        WHERE rdv.ID_Client = :id_client
        ORDER BY rdv.Date_heure DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
$stmt->execute();

$consultations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des Consultations</title>
    <style>
        body {
            background-color: #0C1A1A;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #003333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #00FF00;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #008080;
            text-align: left;
        }
        th {
            background-color: #008080;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historique des Consultations</h1>
        <table>
            <thead>
                <tr>
                    <th>Date et Heure</th>
                    <th>Statut</th>
                    <th>Médecin</th>
                    <th>Spécialité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultations as $consultation): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($consultation['Date_heure']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['Statut']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['Nom'] . ' ' . $consultation['Prenom']); ?></td>
                        <td><?php echo htmlspecialchars($consultation['Specialite']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
