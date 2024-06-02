<?php
require_once 'config.php';

// Récupérer l'ID du médecin à partir de l'URL
$id_service = $_GET['id'];

// Récupérer les informations du médecin à partir de la base de données
$sql = "SELECT * FROM services WHERE ID_Services = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id_medecin);
$stmt->execute();
$service = $stmt->fetch();


// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $info = $_POST['info'];

    // Ajouter le médecin dans la base de données
    $sql = "INSERT INTO services (Nom_Service, Informations) 
            VALUES (:nom, :info)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':info', $info);
    $stmt->execute();

    // Mettre à jour les informations du médecin dans la base de données
    $sql = "UPDATE services SET Nom_Service = :nom, Informations = :info WHERE ID_Services = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id_service);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':info', $info);
    $stmt->execute();

    // Rediriger vers la page d'accueil
    header('Location: dashboard_admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <title>Modifier un service</title>
    </script>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #008080;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .small-link {
            font-size: 0.8em;
        }

        .col-lg-4 {
            border-radius: 5px;
        }

        .btn-custom {
            background-color: #8dd2c2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-9 bg-white m-auto rounded-top">
            <button type="button" class="btn btn-secondary mt-3 ml-3" onclick="history.back()">Retour</button>
                <br><h2 class="text-center"> Modifier un service</h2><br><br>
                <form action="modifier_service.php?id=<?= $id_service ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fa fa-user">
                                    </i>
                                </span>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?= $service['Nom_Service'] ?>" placeholder="Nom">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fa fa-user">
                                    </i>
                                </span>
                                <textarea class="form-control" id="info" name="info" value="<?= $service['Informations'] ?>" placeholder="Informations" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <br><button type="submit" class="btn btn-custom" id="submit-btn" style="background-color: #8dd2c2;"><i class="fa fa-save"></i> Enregistrer les modifications</button><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionnez le bouton de soumission du formulaire
            const submitBtn = document.getElementById("submit-btn");

            // Ajoutez un gestionnaire d'événements de soumission de formulaire
            submitBtn.addEventListener("click", function(event) {
                // Empêchez le formulaire de se soumettre immédiatement
                event.preventDefault();

                // Soumettez le formulaire manuellement
                const form = event.target.closest("form");
                form.submit();

                // Affichez une boîte de dialogue d'alerte indiquant que la modification a été effectuée avec succès
                alert("La modification a été effectuée avec succès !");
            });
        });
    </script>
</body>
</html>