<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../controller/AbonnementC.php';
include '../model/Abonnement.php';

$abonnementC = new AbonnementC();
$erreur = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDuser = $_POST['IDuser'] ?? null;
    $IDpackuser = $_POST['IDpackuser'] ?? null;
    $dateabonnement = $_POST['dateabonnement'] ?? null;
    $payed = $_POST['payed'] ?? null;

    // Validez les entrées si nécessaire

    if (!empty($IDuser) && !empty($IDpackuser) && !empty($dateabonnement) && isset($payed)) {
        $abonnement = new Abonnement($IDuser, $IDpackuser, $dateabonnement, $payed);

        try {
            $abonnementC->addAbonnement($abonnement);

            // Intégration de Stripe commence ici
            require_once '../vendor/autoload.php';
            require_once '../secrets.php';

            \Stripe\Stripe::setApiKey($stripeSecretKey);

            header('Content-Type: application/json');

            $YOUR_DOMAIN = 'http://localhost:4242';

            try {
                $prices = \Stripe\Price::all([
                    // retrieve lookup_key from form data POST body
                    'lookup_keys' => [$_POST['lookup_key']],
                    'expand' => ['data.product']
                ]);

                $checkout_session = \Stripe\Checkout\Session::create([
                    'line_items' => [[
                        'price' => $prices->data[0]->id,
                        'quantity' => 1,
                    ]],
                    'mode' => 'subscription',
                    'success_url' => $YOUR_DOMAIN . '/success.html?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
                ]);

                header("HTTP/1.1 303 See Other");
                header("Location: " . $checkout_session->url);
            } catch (Error $e) {
                http_response_code(500);
                echo json_encode(['error' => $e->getMessage()]);
            }
            // Fin de l'intégration de Stripe

            exit();
        } catch (Exception $e) {
            $erreur = 'Erreur lors de l\'ajout de l\'abonnement : ' . $e->getMessage();
        }
    } else {
        $erreur = 'Toutes les informations sont obligatoires.';
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnement</title>
</head>

<body>
    <a href="listAbonnements.php">Back to list</a>
    <hr>

    <p><?php echo $erreur; ?></p>

    <form action="" method="POST">
        <label for="IDuser">ID User :</label>
        <input type="number" id="IDuser" name="IDuser" required />
        <br>

        <label for="IDpackuser">ID Pack User :</label>
        <input type="number" id="IDpackuser" name="IDpackuser" required />
        <br>

        <label for="dateabonnement">Date Abonnement :</label>
        <input type="date" id="dateabonnement" name="dateabonnement" required />
        <br>

        <label for="payed">Payed :</label>
        <input type="checkbox" id="payed" name="payed" value="1" />
        <br>

        <!-- Ajoutez ici un champ pour le lookup_key -->
        <label for="lookup_key">Lookup Key :</label>
        <input type="text" id="lookup_key" name="lookup_key" required />
        <br>

        <input type="submit" value="Save">
        <input type="reset" value="Reset">
    </form>
</body>

</html>
