<?php
// Includi il file di configurazione e la connessione al database
include 'config.php';
include 'database.php';

// Esegui una query per ottenere tutti i dipendenti
$query = "SELECT * FROM dipendenti";
$result = mysqli_query($connection, $query);

// Verifica se ci sono risultati
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3'>";
        //echo "<div class='card-header'>ID: " . $row['id'] . "</div>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nome'] . " " . $row['cognome'] . "</h5>";
        echo "<p class='card-text'>Ruolo: " . $row['ruolo'] . "</p>";
        echo "<p class='card-text'>Data Assunzione: " . $row['data_assunzione'] . "</p>";
        echo "<p class='card-text'>Data Nascita: " . $row['data_nascita'] . "</p>";
        echo "<p class='card-text'>Email: " . $row['email'] . "</p>";
        echo "<button class='btn btn-info btn-edit' data-id='" . $row['id'] . "'>Modifica</button> ";
        echo "<button class='btn btn-danger btn-delete' data-id='" . $row['id'] . "'>Elimina</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p>Nessun dipendente trovato.</p>";
}

// Chiudi la connessione al database
mysqli_close($connection);
?>