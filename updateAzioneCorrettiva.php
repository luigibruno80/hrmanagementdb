<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $descrizione = $_POST['descrizione'];
    $data = $_POST['data'];
    $responsabileId = $_POST['responsabile']; // ID del responsabile
    $stato = $_POST['stato'];

    // Aggiungi una query per ottenere il nome e il cognome del responsabile
    $responsabileQuery = "SELECT nome, cognome FROM utenti WHERE id = $responsabileId";
    $responsabileResult = mysqli_query($connection, $responsabileQuery);

    if ($responsabileResult && mysqli_num_rows($responsabileResult) > 0) {
        $responsabileData = mysqli_fetch_assoc($responsabileResult);
        $responsabileNome = $responsabileData['nome'];
        $responsabileCognome = $responsabileData['cognome'];

        // Query per l'aggiornamento dell'azione correttiva
        $query = "UPDATE azioni_correttive
                  SET descrizione = '$descrizione', data = '$data', responsabile_nome = '$responsabileNome', responsabile_cognome = '$responsabileCognome', stato = '$stato'
                  WHERE id = $id";

        if (mysqli_query($connection, $query)) {
            echo 'Azione correttiva aggiornata con successo!';
        } else {
            echo 'Si è verificato un errore durante l\'aggiornamento dell\'azione correttiva: ' . mysqli_error($connection);
        }
    } else {
        echo 'Errore nel recupero del responsabile.';
    }
} else {
    echo 'Metodo non consentito. Si prega di utilizzare una richiesta POST per aggiornare un\'azione correttiva.';
}

mysqli_close($connection);
?>