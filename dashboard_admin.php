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
            width: 100%;
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
                <li><a href="gestion_PS.php">Personnel de santé</a></li>
                <li><a href="labo.php">Laboratoire de biologie médicale</a></li>
                <li class="nav-item">
                    <a href="rendezvous.html">
                        <span data-feather="message-square"></span>
                        Messagerie
                        <span class="badge bg-primary rounded-pill ms-2"></span>
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
                    
                </main>
            </div>
        </div>
    </div>
</body>
</html>
