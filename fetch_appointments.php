<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "rdvmedicare";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Supposons que l'utilisateur est connecté et que son ID utilisateur est stocké dans une session
session_start();
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM appointments WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$output = '';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $output .= '<div class="card appointment-card">
                        <div class="card-body">
                            <h5 class="card-title">Rendez-vous avec Dr. ' . $row['doctor_name'] . '</h5>
                            <p class="card-text"><strong>Date et heure :</strong> ' . date('d/m/Y H:i', strtotime($row['appointment_date'])) . '</p>
                            <p class="card-text"><strong>Adresse :</strong> ' . $row['address'] . '</p>
                            <p class="card-text"><strong>Informations de paiement :</strong> ' . $row['payment_info'] . '</p>
                            <p class="card-text"><strong>Digicode :</strong> ' . $row['digicode'] . '</p>
                            <button class="btn btn-danger cancel-appointment" data-id="' . $row['id'] . '">Annulation de RDV</button>
                        </div>
                    </div>';
    }
} else {
    $output = '<p>Aucun rendez-vous confirmé.</p>';
}

echo $output;

$conn->close();
?>
