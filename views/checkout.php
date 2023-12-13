<?php

require_once "stripe-php/init.php";
require_once '../controller/PackC.php';

$stripe_secret_key = "sk_test_51OHotbIUNFbNVA8jKmPysVIRp7D8UsENtR2DrUiwRZlKwmcBBilKGG4UXNBxjXnk6LcTukxPndb3SoxoCA6PFg5b00QeQtkZ08";

\Stripe\Stripe::setApiKey($stripe_secret_key);

// Récupérez l'ID du pack depuis la requête GET
$idPack = $_GET['idPack'] ?? null;

if (!$idPack) {
    // Si l'ID du pack n'est pas fourni, redirigez l'utilisateur
    header("Location: error.php");
    exit;
}

// Créez une instance de la classe PackC
$packC = new PackC();

// Récupérez les détails du pack
$packDetails = $packC->showPack($idPack);

if (!$packDetails) {
    // Si les détails du pack ne sont pas valides, redirigez l'utilisateur
    header("Location: error.php");
    exit;
}

// Calculer le montant total à payer en cents (convertissez-le en cents en multipliant par 100)
$totalAmount = $packDetails['prix'] * 100;

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/diazeninteg/views/success.php?idPack=" . $idPack,
    "cancel_url" => "http://localhost/diazeninteg/views/payment.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => $totalAmount,
                "product_data" => [
                    "name" => $packDetails['nompack'],
                ],
            ],
        ],
    ],
]);

http_response_code(303);
header("Location: " . $checkout_session->url);
