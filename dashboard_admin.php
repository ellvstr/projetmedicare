<?php
    // Inclusion du fichier de configuration de la base de données
    require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'GenericTechno';
            src: url('fonts/projetmedicare/generic-techno/GenericTechno.woff2') format('woff2'),
                 url('fonts/projetmedicare/generic-techno/GenericTechno.woff') format('woff'),
                 url('fonts/projetmedicare/generic-techno/GenericTechno.otf') format('opentype');
        }

        body {
            margin: 0;
            font-family: 'GenericTechno', sans-serif;
            background-color: #008080;
            color: white;
        }
        .wrapper {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            background-color: black;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            box-sizing: border-box;
        }
        header {
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            color: #3da09a;
        }

        header .teal {
            color: #3da09a;
        }

        header .light-teal {
            color: #8dd2c2;
        }

        header .logo {
            margin-left: 20px;
            height: 50px;
        }

        nav {
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: space-around;
            margin: 0;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
            background-color: #3da09a;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 16px;
        }

        nav ul li a:hover {
            background-color: #8dd2c2;
        }

        td, th {
            white-space: normal;
            word-wrap: break-word;
        }

        th.telephone {
            width: 200px;
        }

        td.telephone {
            white-space: pre;
        }

        .search-bar {
            max-width: 400px;
        }

        .sticky-header{
            position: sticky; left: 0;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <div class="header-content">
                <h1><span class="teal">MEDICARE.</span> <span class="light-teal"><br>Au Service de la Santé</span></h1>
                <img src="img/ordremedical.jpg" alt="Ordre Medical Logo" class="logo">
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="accueil.html">Accueil</a></li>
                <li><a href="toutparcourir.html">Tout Parcourir</a></li>
                <li><a href="recherche.html">Recherche</a></li>
                <li class="nav-item">
                    <a href="rendezvous.html">
                        <span data-feather="message-square"></span>
                        Messagerie
                        <span class="badge bg-primary rounded-pill ms-2">3</span>
                    </a>
                </li>                
                <li><a href="index.html">Se déconnecter</a></li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <main>
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Compte Administrateur</h1>
                    </div>
                    
                    <div class="table-responsive">
                        <div class="sticky-header">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h2>Liste du personnel de santé</h2>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                <div class="input-group search-bar">
                                    <input type="text" class="form-control" id="search-input" placeholder="Rechercher...">
                                    <button class="btn btn-primary" type="button" id="search-btn"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <br><a href="ajouter_medecin.php" class="btn btn-primary">Ajouter</a><br>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-sm">
                            <thead>                                                                                                       
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Spécialité</th>
                                    <th>Salle</th>
                                    <th>CV</th>
                                    <th>Email</th>
                                    <th>Mot de passe</th>
                                    <th class="telephone">Téléphone</th>
                                    <th>Photo</th>
                                    <th>Vidéo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT ID_Medecin, Nom_M_PS, Prenom_M_PS, Specialite, Salle, CV, E_mail_M_PS, Mdp_M_PS, Telephone_M_PS, Photo, Video FROM medecin_et_professionnel_de_sante";
                            $result = $pdo->query($sql);

                            if ($result->rowCount() > 0) {
                                
                                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<tr class='clickable-row'>
                                            <td>" . $row["ID_Medecin"] . "</td>
                                            <td>" . $row["Nom_M_PS"] . "</td>
                                            <td>" . $row["Prenom_M_PS"] . "</td>
                                            <td>" . $row["Specialite"] . "</td>
                                            <td>" . $row["Salle"] . "</td>
                                            <td><img src='" . $row["CV"] . "' alt='CV' height='100' width='100' onclick='openImageInNewTab(event)'></td>
                                            <td>" . $row["E_mail_M_PS"] . "</td>
                                            <td>" . $row["Mdp_M_PS"] . "</td>
                                            <td class='telephone'>" . $row["Telephone_M_PS"] . "</td>
                                            <td><img src='" . $row["Photo"] . "' alt='Photo' height='100' width='100' onclick='openImageInNewTab(event)'></td>
                                            <td><video src='" . $row["Video"] . "' alt='Vidéo' height='100' width='100' controls controlsList='nodownload' onclick='openVideoInNewTab(event)'></video></td>
                                            <td>
                                                <a href='modifier_medecin.php?id=" . $row['ID_Medecin'] . "' class='btn btn-primary btn-sm'>Modifier</a>
                                                <button type='button' class='btn btn-danger btn-sm delete-btn' data-id='" . $row['ID_Medecin'] . "'>Supprimer</button>
                                            </td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='12'>Aucun résultat trouvé.</td></tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                if (confirm('Êtes-vous sûr de vouloir supprimer ce médecin ?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'supprimer_medecin.php',
                        data: { id: id },
                        success: function(response) {
                            if (response == 'success') {
                                alert('Le médecin a été supprimé avec succès.');
                                location.reload();
                            } else {
                                alert('Une erreur s\'est produite lors de la suppression du médecin.');
                            }
                        }
                    });
                }
            });
        });

        function openImageInNewTab(event) {
            var imageUrl = event.target.src;
            window.open(imageUrl, '_blank');
        }

        function openVideoInNewTab(video) {
            var videoUrl = video.src;
            window.open(videoUrl, '_blank');
        }

        // Sélectionnez la barre de recherche et le bouton de recherche
        const searchInput = document.getElementById("search-input");
        const searchBtn = document.getElementById("search-btn");

        // Ajoutez un gestionnaire d'événements de clic sur le bouton de recherche
        searchBtn.addEventListener("click", function() {
            // Récupérez la valeur de la barre de recherche
            const searchValue = searchInput.value.toLowerCase();

            // Sélectionnez toutes les lignes du tableau
            const rows = document.querySelectorAll("tbody tr");

            // Parcourez toutes les lignes du tableau
            for (let i = 0; i < rows.length; i++) {
                // Sélectionnez toutes les cellules de la ligne courante
                const cells = rows[i].querySelectorAll("td");

                // Définissez une variable pour indiquer si la ligne courante contient la valeur de la recherche
                let match = false;

                // Parcourez toutes les cellules de la ligne courante
                for (let j = 0; j < cells.length; j++) {
                    // Vérifiez si la cellule courante contient la valeur de la recherche
                    if (cells[j].textContent.toLowerCase().indexOf(searchValue) !== -1) {
                        // Définissez la variable match sur true
                        match = true;

                        // Arrêtez la boucle sur les cellules
                        break;
                    }
                }

                // Si la ligne courante ne contient pas la valeur de la recherche, masquez-la
                if (!match) {
                    rows[i].style.display = "none";
                } else {
                    // Sinon, affichez-la
                    rows[i].style.display = "";
                }
            }
        });

        // sélectionnez toutes les lignes du tableau
        const rows = document.querySelectorAll(".clickable-row");

        // ajoutez un gestionnaire d'événements de double-clic sur chaque ligne
        for (let i = 0; i < rows.length; i++) {
            rows[i].addEventListener("dblclick", function() {
                // récupérez l'ID du médecin à partir de la colonne ID
                const id = this.querySelector("td:nth-child(1)").textContent;

                // redirigez l'utilisateur vers la page des disponibilités du médecin
                window.location.href = "disponibilites.php?id=" + id;
            });
        }
    </script>
</body>
</html>
