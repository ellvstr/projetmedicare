<?php
require_once 'config.php';

$id = $_POST['id'];

$sql = "DELETE FROM medecin_et_professionnel_de_sante WHERE ID_Medecin = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();

echo 'success';
exit;
?>