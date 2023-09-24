<?php
require_once 'config.php';

// Connessione al database
$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica della connessione
if($connection->connect_error){
    die("Errore di connessione: " . $connection->connect_error);
}
?>