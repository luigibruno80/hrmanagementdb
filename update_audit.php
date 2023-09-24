<?php
// Include il file di configurazione
require_once 'config.php';

// Include il file per la connessione al database
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $titolo = $_POST["titolo"];
    $data = $_POST["data"];
    $auditor = $_POST["auditor"];
    $stato = $_POST["stato"];

    // Query per l'aggiornamento del record di audit
    $sql = "UPDATE audit SET titolo='$titolo', data='$data', auditor='$auditor', stato='$stato' WHERE id=$id";

    if ($connection->query($sql) === TRUE) {
        echo "Record di audit aggiornato con successo!";
    } else {
        echo "Errore durante l'aggiornamento del record di audit: " . $connection->error;
    }
}

// Chiudi la connessione al database
$connection->close();
?>