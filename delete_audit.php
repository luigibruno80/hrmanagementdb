<?php
// Include il file di configurazione
require_once 'config.php';

// Include il file per la connessione al database
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    // Query per la cancellazione del record di audit
    $sql = "DELETE FROM audit WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        echo "Record di audit cancellato con successo!";
    } else {
        echo "Errore durante la cancellazione del record di audit: " . $connection->error;
    }
}

// Chiudi la connessione al database
$connection->close();
?>