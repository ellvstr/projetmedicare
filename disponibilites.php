<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id_medecin = $_GET['id'];

    // Récupérer les informations du médecin
    $sql = "SELECT * FROM medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_medecin, PDO::PARAM_INT);
    $stmt->execute();
    $medecin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupérer les disponibilités du médecin
    $sql_dispos = "SELECT * FROM disponibilites WHERE ID_Medecin = :id";
    $stmt_dispos = $pdo->prepare($sql_dispos);
    $stmt_dispos->bindParam(':id', $id_medecin, PDO::PARAM_INT);
    $stmt_dispos->execute();
    $disponibilites = $stmt_dispos->fetchAll(PDO::FETCH_ASSOC);

    // S'il n'y a pas de disponibilités, insérer les disponibilités par défaut
    if (empty($disponibilites)) {
        $jours_semaine = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
        $creneaux = ['AM', 'PM'];

        foreach ($jours_semaine as $jour) {
            foreach ($creneaux as $creneau) {
                $sql_insert = "INSERT INTO disponibilites (Jour_semaine, Horaire, Statut, ID_Medecin) VALUES (:jour, :creneau, 'disponible', :id)";
                $stmt_insert = $pdo->prepare($sql_insert);
                $stmt_insert->bindParam(':jour', $jour, PDO::PARAM_STR);
                $stmt_insert->bindParam(':creneau', $creneau, PDO::PARAM_STR);
                $stmt_insert->bindParam(':id', $id_medecin, PDO::PARAM_INT);
                $stmt_insert->execute();
            }
        }

        // Recharger les disponibilités après insertion
        $stmt_dispos->execute();
        $disponibilites = $stmt_dispos->fetchAll(PDO::FETCH_ASSOC);
    }

    $disponibilites_map = [];
    foreach ($disponibilites as $dispo) {
        $disponibilites_map[$dispo['Jour_semaine']][$dispo['Horaire']] = $dispo['Statut'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disponibilités - Dr. <?= htmlspecialchars($medecin['Nom_M_PS']) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #008080;
            color: white;
        }
        .card {
            width: 80%;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: white;
            color: black;
        }
        .header {
            display: flex;
            align-items: center;
        }
        .header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
        .schedule {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .schedule, .schedule th, .schedule td {
            border: 1px solid #000;
        }
        .schedule th, .schedule td {
            padding: 10px;
            text-align: center;
        }
        .schedule th {
            background-color: #f2f2f2;
        }
        .button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            color: white;
            background-color: #008080;
            border: none;
            border-radius: 5px;
        }
        .button.save {
            background-color: blue;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <img src="<?= htmlspecialchars($medecin['Photo']) ?>" alt="Photo du Dr. <?= htmlspecialchars($medecin['Nom_M_PS']) ?>" width="230" height="250">
            <div>
                <h1>Dr. <?= htmlspecialchars($medecin['Nom_M_PS']) . ' ' . htmlspecialchars($medecin['Prenom_M_PS']) ?></h1>
                <p><strong>Spécialité :</strong> <?= htmlspecialchars($medecin['Specialite']) ?></p>
                <p><strong>Salle :</strong> <?= htmlspecialchars($medecin['Salle']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($medecin['Telephone_M_PS']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($medecin['E_mail_M_PS']) ?></p>
            </div>
        </div>
        <div class="details">
            <table class="schedule">
                <thead>
                    <tr>
                        <th rowspan="2">Spécialité</th>
                        <th rowspan="2">Médecin</th>
                        <?php foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $jour) : ?>
                            <th colspan="2"><?= $jour ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $jour) : ?>
                            <th>AM</th>
                            <th>PM</th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($medecin['Specialite']) ?></td>
                        <td><?= htmlspecialchars($medecin['Nom_M_PS']) . ' ' . htmlspecialchars($medecin['Prenom_M_PS']) ?></td>
                        <?php foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $jour) : ?>
                            <?php foreach (['AM', 'PM'] as $creneau) : ?>
                                <?php
                                    $statut = isset($disponibilites_map[$jour][$creneau]) ? $disponibilites_map[$jour][$creneau] : 'disponible';
                                    $couleur = $statut === 'indisponible' ? 'black' : 'white';
                                ?>
                                <td style="background-color: <?= $couleur ?>" onclick="toggleColor(this, '<?= $jour ?>', '<?= $creneau ?>')"></td>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
            <button id="modifyButton" class="button" onclick="toggleEdit()">Modifier</button>
        </div>
    </div>

    <script>
    let editing = false;
    const disponibilites = {};

    function toggleColor(cell, jour, creneau) {
        if (editing) {
            if (cell.style.backgroundColor === "black") {
                cell.style.backgroundColor = "white";
                disponibilites[jour + '_' + creneau] = 'disponible';
            } else {
                cell.style.backgroundColor = "black";
                disponibilites[jour + '_' + creneau] = 'indisponible';
            }
        }
    }

    function toggleEdit() {
        editing = !editing;
        const button = document.getElementById("modifyButton");
        if (editing) {
            button.textContent = "Enregistrer";
            button.classList.add("save");
        } else {
            button.textContent = "Modifier";
            button.classList.remove("save");
            saveDisponibilites();
        }
    }

    function saveDisponibilites() {
        const idMedecin = <?= json_encode($id_medecin) ?>;
        const data = { id: idMedecin, disponibilites: disponibilites };

        console.log("Données à envoyer:", data);  // Log les données avant l'envoi

        fetch('save_disponibilites.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            console.log("Réponse du serveur:", data);  // Log la réponse du serveur
            if (data.success) {
                alert("Disponibilités sauvegardées avec succès !");
            } else {
                alert("Erreur lors de la sauvegarde des disponibilités: " + data.message);
            }
        })
        .catch(error => {
            console.error("Erreur lors de la requête:", error);  // Log les erreurs de requête
        });
    }
    </script>

</body>
</html>