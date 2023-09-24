<?php
require_once 'database.php';

// Crea la query di selezione
$query = "SELECT * FROM utenti";
$result = mysqli_query($connection, $query);

// Controlla se ci sono risultati
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['nome'] . " " . $row['cognome'] . "</h5>";
        echo "<p class='card-text'>Email: " . $row['email'] . "</p>";
        echo "<p class='card-text'>Ruolo: " . $row['ruolo'] . "</p>";
        echo "<p class='card-text'>Data di Nascita: " . $row['data_nascita'] . "</p>";
        echo "<p class='card-text'>Codice Fiscale: " . $row['codice_fiscale'] . "</p>";
        echo "<button class='btn btn-primary btn-edit' data-id='" . $row['id'] . "'>Modifica</button> ";
        echo "<button class='btn btn-danger btn-delete' data-id='" . $row['id'] . "'>Elimina</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "Nessun utente trovato!";
}

mysqli_close($connection);
?>