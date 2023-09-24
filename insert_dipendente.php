<?php

require 'database.php';

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$ruolo = $_POST['ruolo'];
$data_assunzione = $_POST['data_assunzione'];
$data_nascita = $_POST['data_nascita'];
$email = $_POST['email'];

$sql = "INSERT INTO dipendenti (nome, cognome, ruolo, data_assunzione, data_nascita, email) VALUES ('$nome', '$cognome', '$ruolo', '$data_assunzione', '$data_nascita', '$email')";

if($connection->query($sql) === TRUE) {
    echo "Dipendente inserito con successo!";
} else {
    echo "Errore: " . $sql . "<br>" . $connection->error;
}

$connection->close();

?>