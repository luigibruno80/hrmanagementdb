<?php
// Include il file di configurazione
require_once 'config.php';

// Include il file per la connessione al database
require_once 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = $_POST["titolo"];
    $data = $_POST["data"];
    $auditor = $_POST["auditor"];
    $stato = $_POST["stato"];

    // Query per l'inserimento del nuovo record di audit
    $sql = "INSERT INTO audit (titolo, data, auditor, stato) VALUES ('$titolo', '$data', '$auditor', '$stato')";

    if ($connection->query($sql) === TRUE) {
        echo "Record di audit inserito con successo!";
    } else {
        echo "Errore durante l'inserimento del record di audit: " . $connection->error;
    }
}

// Chiudi la connessione al database
$connection->close();
?>