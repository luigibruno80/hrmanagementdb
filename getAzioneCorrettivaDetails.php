<?php
// Includi il file di configurazione e la connessione al database
include 'config.php';
include 'database.php';

// Assicurati che un ID sia stato passato come parametro
if(isset($_POST['id'])) {
    $azione_correttiva_id = $_POST['id'];

    // Esegui una query per ottenere i dettagli dell'azione_correttiva con l'ID specificato
    $query = "SELECT * FROM azioni_correttive WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $azione_correttiva_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Se è stato trovato un azione_correttiva con quell'ID, restituisci i suoi dettagli
    if($result->num_rows > 0) {
        $azione_correttiva = $result->fetch_assoc();
        echo json_encode($azione_correttiva);
    } else {
        echo json_encode(["message" => "Nessun azione_correttiva trovato con l'ID specificato."]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "ID azione_correttiva non fornito."]);
}

// Chiudi la connessione al database
mysqli_close($connection);
?>