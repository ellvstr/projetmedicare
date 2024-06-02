<?php
// Inclusion du fichier de configuration de la base de données
require_once 'config.php';

// Récupérer l'ID du médecin à partir de l'URL
$id_medecin = $_GET['id'];

// Récupérer les informations du médecin à partir de la base de données
$sql = "SELECT * FROM medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id_medecin);
$stmt->execute();
$medecin = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='css/bootstrap.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/all.min.css'>
    <title>Ajouter un CV</title>

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
                <br><h2 class="text-center">Ajouter un CV</h2><br><br>
                <form action="sauvegarder_cv.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_medecin" value="<?= $id_medecin ?>">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="nom" name="nom" value="<?= $medecin['Nom_M_PS'] ?>" placeholder="Nom">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $medecin['Prenom_M_PS'] ?>" placeholder="Prénom">
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" id="email" name="email" value="<?= $medecin['E_mail_M_PS'] ?>" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $medecin['Telephone_M_PS'] ?>" placeholder="Téléphone">
                            </div>
                            <div class="mb-3">
                                <label for="competences" class="form-label">Compétences</label>
                                <textarea class="form-control" id="competences" name="competences" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="loisirs" class="form-label">Loisirs</label>
                                <textarea class="form-control" id="loisirs" name="loisirs" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="experiences" class="form-label">Expériences professionnelles (Année - Expérience)</label>
                                <textarea class="form-control" id="experiences" name="experiences" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formations" class="form-label">Formations (Année - Formation)</label>
                                <textarea class="form-control" id="formations" name="formations" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <h4>Informations du profil</h4>
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" value="<?= $medecin['Nom_M_PS'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $medecin['Prenom_M_PS'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="specialite" class="form-label">Spécialité</label>
                                <input type="text" class="form-control" id="specialite" name="specialite" value="<?= $medecin['Specialite'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="salle" class="form-label">Salle</label>
                                <input type="text" class="form-control" id="salle" name="salle" value="<?= $medecin['Salle'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $medecin['E_mail_M_PS'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $medecin['Telephone_M_PS'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <br><button type="submit" class="btn btn-custom" style="background-color: #8dd2c2;"><i class="fa fa-save"></i> Enregistrer le CV</button><br>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>