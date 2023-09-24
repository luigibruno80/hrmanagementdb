<?php
// Include il file di configurazione
require_once 'config.php';

// Include il file per la connessione al database
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Query per ottenere i dettagli del record di audit
    $sql = "SELECT * FROM audit WHERE id=$id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Nessun record di audit trovato con questo ID.";
    }
}

// Chiudi la connessione al database
$connection->close();
?>