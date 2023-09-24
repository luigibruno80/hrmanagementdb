<?php
// Includi il file di configurazione e la connessione al database
include 'config.php';
include 'database.php';

// Assicurati che un ID sia stato passato come parametro
if(isset($_POST['id'])) {
    $utente_id = $_POST['id'];

    // Esegui una query per ottenere i dettagli dell'utente con l'ID specificato
    $query = "SELECT * FROM utenti WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $utente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se è stato trovato un utente con quell'ID, restituisci i suoi dettagli
    if($result->num_rows > 0) {
        $utente = $result->fetch_assoc();
        echo json_encode($utente);
    } else {
        echo json_encode(["message" => "Nessun utente trovato con l'ID specificato."]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "ID utente non fornito."]);
}

// Chiudi la connessione al database
mysqli_close($connection);
?>