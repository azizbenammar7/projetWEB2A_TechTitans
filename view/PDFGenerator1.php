<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PDFGenerator1 {
    public function generatePDF1($medicament) {
        // Create a Dompdf instance
        $dompdf = new Dompdf();

        // Load HTML content with patient data in a table
        $html = '<html><body>';
        $html .= '<h1>Patient Fiche</h1>';

        // Add patient data in a table
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr><th>ID</th><th>Creatinine Serique</th><th>Glycemie</th><th>Cholesterol</th><th>Date Ajout</th></tr>';
        $html .= '<tr>';
        $html .= '<td>'.$medicament->getidfiche().'</td>';
        $html .= '<td>'.$medicament->getNom().'</td>';
        $html .= '<td>'.$medicament->getglyc().'</td>';
        $html .= '<td>'.$medicament->getchol().'</td>';
        $html .= '<td>'.$medicament->getDateAjout().'</td>';
        $html .= '</tr>';

        // Add Remarques sections
        $html .= '<tr>';
        $html .= '<td colspan="5"><strong>Remarques:</strong> ';
        $html .= $this->generateRemarques($medicament);
        $html .= '</td>';
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
        $filename = 'patient_fiche_'.$medicament->getidfiche().'.pdf';

        // Output the PDF for download
        $dompdf->stream($filename, array('Attachment' => 0));
        $output = $dompdf->output();
        file_put_contents('../pdf/'.$filename, $output);
        
        // Create an instance; passing `true` enables exceptions
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
           $mail->setFrom('gastonishere1000@gmail.com', 'Diazen');
           $mail->addAddress('bousselemghassen03@gmail.com',$medicament->getidfiche() );     //Add a recipient
           $mail->addReplyTo('gastonishere1000@gmail.com', 'Information');
            // Attachments
            $mail->addAttachment('../pdf/'.$filename);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Nouvelle analyse';
            $mail->Body = '<b>Nouvelle analyse ajoutée avec succés!</b>';
            $mail->AltBody = 'Bonjour'.$medicament->getidfiche().' si tu as un probléme appele nous 69696969';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function generateRemarques($medicament) {
        // Retrieve the values
        $hdlCholesterol = $medicament->getchol();
        $glycAJeun = $medicament->getglyc();
        $creatinineSerique = $medicament->getNom();

        // Normal ranges
        $normalRangeHDL = array('min' => 10, 'max' => 30);
        $normalRangeGlyc = array('min' => 6, 'max' => 15);
        $normalRangeCreatinine = array('min' => 0, 'max' => 10);

        // Initialize remarks
        $remarks = '';

        // Check HDL Cholestérol
        if ($hdlCholesterol >= $normalRangeHDL['min'] && $hdlCholesterol <= $normalRangeHDL['max']) {
            $remarks .= 'HDL Cholestérol is normal. ';
        } else {
            $remarks .= 'HDL Cholestérol is not normal. ';
        }

        // Check Glycémie à jeun
        if ($glycAJeun >= $normalRangeGlyc['min'] && $glycAJeun <= $normalRangeGlyc['max']) {
            $remarks .= 'Glycémie à jeun is normal. ';
        } else {
            $remarks .= 'Glycémie à jeun is not normal. ';
        }

        // Check Créatinine Sérique
        if ($creatinineSerique >= $normalRangeCreatinine['min'] && $creatinineSerique <= $normalRangeCreatinine['max']) {
            $remarks .= 'Créatinine Sérique is normal. ';
        } else {
            $remarks .= 'Créatinine Sérique is not normal. ';
        }

        return $remarks;
    }
}
?>
