<?php
require_once 'database.php';

// Controlla se i dati sono stati inviati
if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['ruolo']) && isset($_POST['data_assunzione']) && isset($_POST['data_nascita']) && isset($_POST['email'])) {
    
    // Prepara i dati per l'inserimento
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $nome = mysqli_real_escape_string($connection, $_POST['nome']);
    $cognome = mysqli_real_escape_string($connection, $_POST['cognome']);
    $ruolo = mysqli_real_escape_string($connection, $_POST['ruolo']);
    $data_assunzione = mysqli_real_escape_string($connection, $_POST['data_assunzione']);
    $data_nascita = mysqli_real_escape_string($connection, $_POST['data_nascita']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    
    // Crea la query di aggiornamento
    $query = "UPDATE dipendenti SET nome = '$nome', cognome = '$cognome', ruolo = '$ruolo', data_assunzione = '$data_assunzione', data_nascita = '$data_nascita', email = '$email' WHERE id = $id";
    
    // Esegui la query
    if (mysqli_query($connection, $query)) {
        echo "Dipendente aggiornato con successo!";
    } else {
        echo "Errore: " . mysqli_error($connection);
    }
    
} else {
    echo "Errore: dati non ricevuti correttamente!";
}

mysqli_close($connection);
?>