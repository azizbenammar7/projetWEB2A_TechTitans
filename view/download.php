<?php
$filename = $_GET['filename'];
$uploadDir = __DIR__ . '/../view/upload/';
$filepath = $uploadDir . $filename;

// Assurez-vous que le fichier existe avant de l'afficher
if (file_exists($filepath)) {
    // Obtenez l'extension du fichier
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    // Déterminez le type MIME en fonction de l'extension
    if ($ext === 'png') {
        $mime = 'image/png';
    } elseif ($ext === 'pdf') {
        $mime = 'application/pdf';
    } else {
        $mime = mime_content_type($filepath);
    }

    // Définissez le type MIME dans l'en-tête Content-Type
    header('Content-Type: ' . $mime);

    // Utilisez rawurlencode pour gérer les caractères spéciaux dans le nom du fichier
    $encodedFilename = rawurlencode($filename);

    // Définissez le type d'encodage de l'en-tête Content-Disposition
    header('Content-Disposition: attachment; filename="' . $encodedFilename . '"');
    
    // Lisez le fichier et affichez son contenu en tant que binaire
    readfile($filepath);
    exit;
} else {
    echo 'Fichier non trouvé.';
}
?>
