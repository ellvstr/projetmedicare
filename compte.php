<?php
include 'db_connection.php';
session_start();

if (!isset($_SESSION['client_id'])) {
    header("Location: login.php");
    exit();
}

$client_id = $_SESSION['client_id'];

$sql = "SELECT * FROM Client WHERE ID_Client = :client_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':client_id', $client_id);
$stmt->execute();
$client = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT r.*, m.Nom AS Nom_Medecin, m.Prenom AS Prenom_Medecin, l.Nom_Labo FROM Rendez_vous r
        LEFT JOIN Medecin_et_professionnel_de_sante m ON r.ID_Medecin = m.ID_Medecin
        LEFT JOIN Laboratoire_de_Biologie_Medicale l ON r.ID_Labo = l.ID_Labo
        WHERE r.ID_Client = :client_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':client_id', $client_id);
$stmt->execute();
$rendez_vous = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Votre Compte</title>
    <style>
        body {
            background-color: #0C1A1A; /* Couleur de fond */
            color: #FFFFFF; /* Couleur du texte */
            font-family: Arial, sans-serif;
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
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #003333; /* Couleur de fond du contenu */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #008080; /* Couleur du titre */
            text-align: center;
        }
        p, a {
            color: #FFFFFF; /* Couleur du texte et des liens */
        }
        a {
            text-decoration: none;
            color: #00FFFF; /* Couleur des liens */
        }
        a:hover {
            text-decoration: underline;
        }
        .rdv {
            background-color: #004D4D; /* Couleur de fond des rendez-vous */
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
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
        body {
            margin: 0;
            font-family: 'GenericTechno', sans-serif;
            background-color: #008080;
            color: white;
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
            <li><a href="logout.php">Se déconnecter</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Bienvenue, <?php echo htmlspecialchars($client['Prenom_Client'] . " " . $client['Nom_Client']); ?></h1>
        <p>Email: <?php echo htmlspecialchars($client['E_mail_Client']); ?></p>
        <p>Adresse: <?php echo htmlspecialchars($client['Adresse']); ?></p>
        <p>Carte Vitale: <?php echo htmlspecialchars($client['Carte_Vitale']); ?></p>
        
        <h2>Historique des consultations</h2>
        <?php foreach ($rendez_vous as $rdv): ?>
            <div class="rdv">
                <p>Date/Heure: <?php echo htmlspecialchars($rdv['Date_heure']); ?></p>
                <?php if ($rdv['ID_Medecin']): ?>
                    <p>Médecin: Dr. <?php echo htmlspecialchars($rdv['Prenom_Medecin'] . " " . $rdv['Nom_Medecin']); ?></p>
                <?php endif; ?>
                <?php if ($rdv['ID_Labo']): ?>
                    <p>Laboratoire: <?php echo htmlspecialchars($rdv['Nom_Labo']); ?></p>
                <?php endif; ?>
                <p>Statut: <?php echo htmlspecialchars($rdv['Statut']); ?></p>
                <p><a href="annuler_rdv.php?id=<?php echo htmlspecialchars($rdv['ID_Rdv']); ?>">Annuler ce RDV</a></p>
            </div>
        <?php endforeach; ?>
    </div>
                </div>
</body>
</html>
