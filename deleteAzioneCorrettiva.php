<?php
require_once 'database.php';

// Controlla se l'ID è stato fornito
if (isset($_POST['id'])) {
    
    // Prepara l'ID per l'eliminazione
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    
    // Crea la query di eliminazione
    $query = "DELETE FROM azioni_correttive WHERE id = $id";
    
    // Esegui la query
    if (mysqli_query($connection, $query)) {
        echo "Azione Correttiva eliminato con successo!";
    } else {
        echo "Errore: " . mysqli_error($connection);
    }
    
} else {
    echo "Errore: ID non fornito!";
}

mysqli_close($connection);
?>