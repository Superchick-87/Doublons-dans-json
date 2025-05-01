
<?php

// Chemin vers le fichier JSON
$jsonFile = 'datas_20250501_115446.json';

// Vérifie si le fichier existe
if (!file_exists($jsonFile)) {
    die("Fichier JSON non trouvé.");
}

// Lit et décode le fichier JSON
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);

// Vérifie que c'est un tableau
if (!is_array($data)) {
    die("Le contenu JSON est invalide.");
}

// Comptage des IDs
$idCounts = [];
foreach ($data as $entry) {
    $id = $entry['id'];
    if (!isset($idCounts[$id])) {
        $idCounts[$id] = 0;
    }
    $idCounts[$id]++;
}

// Récupération des doublons
$doublons = [];
foreach ($data as $entry) {
    if ($idCounts[$entry['id']] > 1) {
        $doublons[] = $entry;
    }
}

// Affichage des détails des doublons
if (!empty($doublons)) {
    echo "<strong>Entrées avec ID en double :</strong><br><br>";
    foreach ($doublons as $entry) {
        echo "<div style='border:1px solid #ccc; padding:10px; margin-bottom:10px;'>";
        echo "<strong>ID :</strong> " . htmlspecialchars($entry['id']) . " ❌<br>";
        echo "<strong>Titre :</strong> " . htmlspecialchars($entry['Titre'] ?? 'N/A') . "<br>";
        echo "<strong>Date :</strong> " . htmlspecialchars($entry['Date'] ?? 'N/A') . "<br>";
        echo "<strong>Auteur :</strong> " . htmlspecialchars($entry['Auteur'] ?? 'N/A') . "<br>";
        echo "<strong>URL :</strong> <a href='" . htmlspecialchars($entry['Url_web'] ?? '#') . "' target='_blank'>Voir l'article</a><br>";
        echo "</div>";
    }
} else {
    echo "Aucun doublon trouvé.";
}

// // Chemin vers le fichier JSON
// $jsonFile = 'datas_20250501_101629.json';

// // Vérifie si le fichier existe
// if (!file_exists($jsonFile)) {
//     die("Fichier JSON non trouvé.");
// }

// // Lit et décode le fichier JSON
// $jsonData = file_get_contents($jsonFile);
// $data = json_decode($jsonData, true);

// // Vérifie que c'est un tableau
// if (!is_array($data)) {
//     die("Le contenu JSON est invalide.");
// }

// // Comptage des IDs
// $idCounts = [];
// foreach ($data as $entry) {
//     $id = $entry['id'];
//     if (!isset($idCounts[$id])) {
//         $idCounts[$id] = 0;
//     }
//     $idCounts[$id]++;
// }

// // Affichage des IDs en double (une seule fois)
// echo "<strong>Doublons détectés :</strong><br>";
// foreach ($idCounts as $id => $count) {
//     if ($count > 1) {
//         echo "ID : $id ❌<br>";
//     }
// }
