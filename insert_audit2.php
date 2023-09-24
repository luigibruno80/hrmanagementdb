<?php
// Intestazione Content Security Policy
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self'; connect-src 'self';");

// Includo il file di configurazione
require_once 'config.php';

// Tento di effettuare la connessione al database
try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Setto l'attributo PDO::ERRMODE_EXCEPTION
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $titolo = filter_input(INPUT_POST, 'titolo', FILTER_SANITIZE_STRING);
        $titolo = strip_tags(htmlspecialchars($titolo));
        
        $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING); 
        $data = strip_tags(htmlspecialchars($data));
        
        $auditor = filter_input(INPUT_POST, 'auditor', FILTER_SANITIZE_STRING);
        $auditor = strip_tags(htmlspecialchars($auditor));
        
        $stato = filter_input(INPUT_POST, 'stato', FILTER_SANITIZE_STRING);
        $stato = strip_tags(htmlspecialchars($stato));
                
        // Preparo la query SQL
        $sql = "INSERT INTO audit (titolo, data, auditor, stato) VALUES (:titolo, :data, :auditor, :stato)";
        $stmt = $connection->prepare($sql);

        // Eseguo la query con i valori effettivi
        $stmt->execute([':titolo' => $titolo, ':data' => $data, ':auditor' => $auditor, ':stato' => $stato]);
        
        echo "Record di audit inserito con successo!";
    }
} catch (PDOException $e) {
    echo "Errore durante l'inserimento del record di audit: " . $e->getMessage();
}

// Chiudo la connessione al database
$connection = null;
?>