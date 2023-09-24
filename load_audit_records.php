<?php
require_once 'database.php';

$query = "SELECT * FROM audit";
$result = mysqli_query($connection, $query);

$output = '';

while ($row = mysqli_fetch_assoc($result)) {
    $output .= '<div class="card">';
    $output .= '<div class="card-body">';
    $output .= '<h5 class="card-title">' . $row['titolo'] . '</h5>';
    $output .= '<p class="card-text"><strong>Data:</strong> ' . $row['data'] . '</p>';
    $output .= '<p class="card-text"><strong>Auditor:</strong> ' . $row['auditor'] . '</p>';
    $output .= '<p class="card-text"><strong>Stato:</strong> ' . $row['stato'] . '</p>';
    $output .= '<a href="#" class="btn btn-primary btn-edit" data-id="' . $row['id'] . '">Modifica</a>';
    $output .= '<a href="#" class="btn btn-danger btn-delete" data-id="' . $row['id'] . '">Elimina</a>';
    $output .= '</div>';
    $output .= '</div>';
}

echo $output;

mysqli_close($connection);
?>