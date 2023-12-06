<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    public function sendEmail($textContent, $recipientEmail) {
        // Créer une instance; passer à true active les exceptions
        $mail = new PHPMailer(true);

        try {
            // Paramètres du serveur Gmail
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;          // Activer la sortie de débogage verbose
            $mail->isSMTP();                                // Envoi via SMTP
            $mail->Host = 'smtp.gmail.com';                // Définir le serveur SMTP Gmail
            $mail->SMTPAuth = true;                         // Activer l'authentification SMTP
            $mail->Username = 'charradinoamine@gmail.com'; // Adresse e-mail Gmail
            $mail->Password = 'charradaepic123';       // Mot de passe Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Activer le chiffrement TLS explicite
            $mail->Port = 587;                              // Port TCP à utiliser; utilisez 465 pour le chiffrement implicite

            // Destinataire
            $mail->setFrom('charradinoamine@gmail.com', 'Nom de l\'expéditeur');
            $mail->addAddress($recipientEmail); // Adresse e-mail du destinataire
            $mail->addReplyTo('charradinoamine@gmail.com', 'Information');

            // Contenu
            $mail->isHTML(true);
            $mail->Subject = 'Notification: Réponse reçue avec succès';
            $mail->Body = $textContent;
            
            // Envoyer l'e-mail
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
