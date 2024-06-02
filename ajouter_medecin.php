<?php
require_once 'config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $specialite = $_POST['specialite'];
    $salle = $_POST['salle'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $telephone = $_POST['telephone'];

    if ($_FILES['photo']['name']) {
        $photo = 'img/' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
    } 
    
    if ($_FILES['video']['name']) {
        $video = 'video/' . $_FILES['video']['name'];
        move_uploaded_file($_FILES['video']['tmp_name'], $video);
    } 

    // Ajouter le médecin dans la base de données
    $sql = "INSERT INTO medecin_et_professionnel_de_sante (Nom_M_PS, Prenom_M_PS, Specialite, Salle, CV, E_mail_M_PS, Mdp_M_PS, Telephone_M_PS, Photo, Video) 
            VALUES (:nom, :prenom, :specialite, :salle, :email, :mot_de_passe, :telephone, :photo, :video)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':prenom', $prenom);
    $stmt->bindValue(':specialite', $specialite);
    $stmt->bindValue(':salle', $salle);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':mot_de_passe', $mot_de_passe);
    $stmt->bindValue(':telephone', $telephone);
    $stmt->bindValue(':photo', $photo);
    $stmt->bindValue(':video', $video);
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
    <title>Ajouter un médecin</title>
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
                <br><h2 class="text-center">Ajouter un médecin</h2><br><br>
                <form action="ajouter_medecin.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-stethoscope"></i></span>
                                <input type="text" class="form-control" id="specialite" name="specialite" placeholder="Spécialité" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-hospital"></i></span>
                                <input type="text" class="form-control" id="salle" name="salle" placeholder="Salle" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Téléphone" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-image"></i></span>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa fa-video"></i></span>
                                <input type="file" class="form-control" id="video" name="video">
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <br><button type="submit" class="btn btn-custom" id="submit-btn" style="background-color: #8dd2c2;"><i class="fa fa-plus"></i> Ajouter</button><br>
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

                // Affichez une boîte de dialogue d'alerte indiquant que l'ajout a été effectué avec succès
                alert("L'ajout a été effectué avec succès !");

                // Soumettez le formulaire manuellement
                const form = event.target.closest("form");
                form.submit();
            });
        });
    </script>
</body>
</html>