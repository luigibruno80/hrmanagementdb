<?php
require_once 'database.php';
header("refresh:0;url=nuova_pagina.php");
// Verifica se tutti i campi richiesti sono presenti
if (isset($_POST['id'], $_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['password'], $_POST['ruolo'], $_POST['data_nascita'], $_POST['codice_fiscale'])) {
    
    // Prepara i dati ricevuti per l'aggiornamento
    $id = mysqli_real_escape_string(connection, $_POST['id']);
    $nome = mysqli_real_escape_string(connection, $_POST['nome']);
    $cognome = mysqli_real_escape_string(connection, $_POST['cognome']);
    $email = mysqli_real_escape_string(connection, $_POST['email']);
    $password = mysqli_real_escape_string(connection, $_POST['password']); // Potresti voler utilizzare la funzione password_hash() per hashare la password
    $ruolo = mysqli_real_escape_string(connection, $_POST['ruolo']);
    $data_nascita = mysqli_real_escape_string(connection, $_POST['data_nascita']);
    $codice_fiscale = mysqli_real_escape_string(connection, $_POST['codice_fiscale']);

    // Crea la query di aggiornamento
    $query = "UPDATE utenti SET 
                nome = '$nome', 
                cognome = '$cognome', 
                email = '$email', 
                password = '$password', 
                ruolo = '$ruolo', 
                data_nascita = '$data_nascita', 
                codice_fiscale = '$codice_fiscale' 
              WHERE id = $id";
    
    // Esegui la query
    if (mysqli_query(connection, $query)) {
        echo "Utente aggiornato con successo!";
    } else {
        echo "Errore: " . mysqli_error($connection);
    }
    
} else {
    echo "Errore: dati incompleti!";
}

mysqli_close($connection);
?>