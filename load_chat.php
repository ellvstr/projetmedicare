<?php
require_once 'config.php';

$stmt = $pdo->query("SELECT * FROM messages ORDER BY timestamp ASC");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="msgln"><b>' . $row['username'] . ':</b> ' . $row['message'] . '<br></div>';
}
?>
