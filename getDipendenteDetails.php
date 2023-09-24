<?php
// Includi il file di configurazione e la connessione al database
include 'config.php';
include 'database.php';

// Assicurati che un ID sia stato passato come parametro
if(isset($_POST['id'])) {
    $dipendente_id = $_POST['id'];

    // Esegui una query per ottenere i dettagli del dipendente con l'ID specificato
    $query = "SELECT * FROM dipendenti WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $dipendente_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se è stato trovato un dipendente con quell'ID, restituisci i suoi dettagli
    if($result->num_rows > 0) {
        $dipendente = $result->fetch_assoc();
        echo json_encode($dipendente);
    } else {
        echo json_encode(["message" => "Nessun dipendente trovato con l'ID specificato."]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "ID dipendente non fornito."]);
}

// Chiudi la connessione al database
mysqli_close($connection);
?>