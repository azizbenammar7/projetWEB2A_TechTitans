<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PDFGenerator {
    public function generatePDF($idfichee) {
        // Create a Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content with patient data in a table
        $html = '<html><body>';
        $html .= '<h1>Patient Fiche</h1>';

        // Add patient data in a table
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr><th>ID</th><th>Email</th><th>Tel</th><th>Sexe</th></tr>';
        $html .= '<tr>';
        $html .= '<td>'.$idfichee->getidfiche().'</td>';
        $html .= '<td>'.$idfichee->getemail().'</td>';
        $html .= '<td>'.$idfichee->gettel().'</td>';
        $html .= '<td>'.$idfichee->getsexe().'</td>';
        $html .= '</tr>';
        $html .= '</table>';

        $html .= '</body></html>';

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // Set paper size (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (first pass to get total pages)
        $dompdf->render();

        // Generate filename using $idfichee->getidfiche()
        $filename = 'patient_fiche_'.$idfichee->getidfiche().'.pdf';

        // Output the PDF for download
        $dompdf->stream($filename, array('Attachment' => 0));
        $output = $dompdf->output();
        file_put_contents('../pdf/'.$filename, $output);
            //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = 'gastonishere1000@gmail.com';                     //SMTP username
            $mail->Password = 'fcsvxfzzrgrfqcti';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('gastonishere1000@gmail.com', 'Ghassen');
            $mail->addAddress($idfichee->getemail(),$idfichee->getidfiche() );     //Add a recipient
            $mail->addReplyTo('gastonishere1000@gmail.com', 'Information');


            //Attachments
            $mail->addAttachment('../pdf/'.$filename);         //Add attachments

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>