<?php
header('Content-Type: application/json');

if (file_exists('timer.txt')) {
    $end_time = file_get_contents('timer.txt');
    echo json_encode(['end_time' => intval($end_time)]);
} else {
    // Si le fichier n'existe pas, renvoyer 0 ou un autre indicateur
    echo json_encode(['end_time' => 0]);
}
?>
