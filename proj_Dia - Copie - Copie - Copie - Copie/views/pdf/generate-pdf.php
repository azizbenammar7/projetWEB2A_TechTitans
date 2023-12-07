<?php

require __DIR__ . "/vendor/autoload.php";

use Dompdf\Dompdf;
use Dompdf\Options;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_patient = $_POST["nom_patient"];
    $medicament = $_POST["medicament"];
    $quantite = $_POST["quantite"];
    $nom_medecin = $_POST["nom_medecin"];

    // Handle uploaded image
    $uploadDir = __DIR__ . '/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['cachet_medecin']['name']);

    if (move_uploaded_file($_FILES['cachet_medecin']['tmp_name'], $uploadFile)) {
        $cachet_medecin = $uploadFile;
    } else {
        die('Erreur lors de l\'upload du cachet du médecin.');
    }

    // Generate PDF
    $options = new Options;
    $options->setChroot(__DIR__);
    $options->setIsHtml5ParserEnabled(true);

    $dompdf = new Dompdf($options);
    $dompdf->setPaper("A4", "portrait");

    $html = file_get_contents("template.php");

    $html = str_replace(
        ["{{ nom_patient }}", "{{ medicament }}", "{{ quantite }}", "{{ nom_medecin }}", "{{ cachet_medecin }}"],
        [$nom_patient, $medicament, $quantite, $nom_medecin, $cachet_medecin],
        $html
    );

    $dompdf->loadHtml($html);
    $dompdf->render();

    // Save PDF to a file
    $pdfFileName = 'ordonnance.pdf';
    $dompdf->stream($pdfFileName, ["Attachment" => 0]);
    $to = $_POST["email"]; // Added line to get user's email

    // Send email with the PDF attachment
    $subject = 'Ordonnance Médicale';
    $message = 'Veuillez trouver ci-joint l\'ordonnance médicale.';
    $headers = 'From: diazen194@gmail.com'; // Replace with your email address

    // Attach the PDF file to the email
    $pdfContent = file_get_contents($pdfFileName);
    $pdfAttachment = chunk_split(base64_encode($pdfContent));

    $boundary = md5(time());
    $headers .= "\r\nMIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n\r\n";
    $headers .= "--$boundary\r\n";
    $headers .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $headers .= "$message\r\n";
    $headers .= "--$boundary\r\n";
    $headers .= "Content-Type: application/pdf; name=\"$pdfFileName\"\r\n";
    $headers .= "Content-Transfer-Encoding: base64\r\n";
    $headers .= "Content-Disposition: attachment\r\n\r\n";
    $headers .= "$pdfAttachment\r\n";
    $headers .= "--$boundary--";

    // Send the email
    mail($to, $subject, "", $headers);
}
?>

