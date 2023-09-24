<?php
require_once 'database.php';

// Crea la query di selezione con il JOIN per ottenere il nome e il cognome del responsabile
$query = "SELECT a.*, u.nome AS responsabile_nome, u.cognome AS responsabile_cognome
          FROM azioni_correttive a
          LEFT JOIN utenti u ON a.responsabile = u.id";

$result = mysqli_query($connection, $query);

// Controlla se ci sono risultati
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card mb-3'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['descrizione'] . "</h5>";
        echo "<p class='card-text'>Data: " . $row['data'] . "</p>";
        echo "<p class='card-text'>Responsabile: " . $row['responsabile_nome'] . " " . $row['responsabile_cognome'] . "</p>";
        echo "<p class='card-text'>Stato: " . $row['stato'] . "</p>";
        // Aggiungi i pulsanti per modificare ed eliminare
        echo "<button class='btn btn-primary btn-edit' data-id='" . $row['id'] . "'>Modifica</button> ";
        echo "<button class='btn btn-danger btn-delete' data-id='" . $row['id'] . "'>Elimina</button>";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "Nessuna azione correttiva trovata!";
}

mysqli_close($connection);
?>
