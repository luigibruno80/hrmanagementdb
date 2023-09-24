<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $activePageTitle; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .bg-custom {
            background-color: #FFD700; /* Colore arancio leggero */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-custom">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="immagini/logo.png" alt="Logo">
            <!--Gestione-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?php echo $activePage === 'index' ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php echo $activePage === 'gestione_utenti' ? 'active' : ''; ?>">
                    <a class="nav-link" href="gestione_utenti.php">Gestione Utenti</a>
                </li>
                <li class="nav-item <?php echo $activePage === 'gestione_dipendenti' ? 'active' : ''; ?>">
                    <a class="nav-link" href="gestione_dipendenti.php">Gestione Dipendenti</a>
                </li>
                <li class="nav-item <?php echo $activePage === 'gestione_audit' ? 'active' : ''; ?>">
                    <a class="nav-link" href="gestione_audit.php">Gestione Audit</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">