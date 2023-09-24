<?php
require_once 'database.php';

// Verifica se tutti i campi richiesti sono presenti
if (isset($_POST['descrizione'], $_POST['cogdescrizione'], $_POST['id_incidente'], $_POST['password'], $_POST['stato'], $_POST['data'], $_POST[''])) {
    
    // Prepara i dati ricevuti per l'inserimento
    $descrizione = mysqli_real_escape_string($connection, $_POST['descrizione']);
    $cogdescrizione = mysqli_real_escape_string($connection, $_POST['cogdescrizione']);
    $id_incidente = mysqli_real_escape_string($connection, $_POST['id_incidente']);
    $password = mysqli_real_escape_string($connection, $_POST['password']); // Potresti voler utilizzare la funzione password_hash() per hashare la password
    $stato = mysqli_real_escape_string($connection, $_POST['stato']);
    $data = mysqli_real_escape_string($connection, $_POST['data']);
    $ = mysqli_real_escape_string($connection, $_POST['']);

    // Crea la query di inserimento
    $query = "INSERT INTO azioni_correttive (descrizione, cogdescrizione, id_incidente, password, stato, data, ) 
              VALUES ('$descrizione', '$cogdescrizione', '$id_incidente', '$password', '$stato', '$data', '$')";
    
    // Esegui la query
    if (mysqli_query($connection, $query)) {
        echo "Azione Correttiva inserito con successo!";
    } else {
        echo "Errore: " . mysqli_error($connection);
    }
    
} else {
    echo "Errore: dati incompleti!";
}

mysqli_close($connection);
?>