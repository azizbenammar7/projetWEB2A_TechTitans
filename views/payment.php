<?php
// Assurez-vous d'inclure le fichier qui définit votre classe PackC
require_once '../controller/PackC.php';

// Créez une instance de la classe PackC
$packC = new PackC();

// Récupérez l'ID du pack depuis la requête GET
$idPack = $_GET['idPack'] ?? null;

// Assurez-vous que l'ID du pack est valide (vous devrez peut-être effectuer des vérifications supplémentaires ici)
if ($idPack) {
    // Récupérez les détails du pack
    $packDetails = $packC->showPack($idPack);

    if ($packDetails) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Example</title>
    <!-- Ajoutez le script Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f5f5f5; /* Couleur de fond gris clair */
        }

        h1 {
            color: #3498db; /* Bleu clair */
        }

        #payment-form {
            display: inline-block;
            border: 1px solid #3498db; /* Bordure bleue claire */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* Fond blanc */
        }

        #payment-button {
            background-color: #3498db; /* Bleu clair */
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Ajout d'une transition pour un effet fluide */
        }

        #payment-button:hover {
            background-color: #2980b9; /* Légère variation de bleu au survol */
        }
    </style>
</head>
<body>
    <h1>Stripe Example</h1>
    <form id="payment-form">
        <!-- Ajoutez une section pour le nom du produit -->
        <p>Product: <?php echo $packDetails['nompack']; ?></p>

        <!-- Ajoutez une section pour le prix du produit (vous devrez ajuster cela en fonction de votre logique) -->
        <p><strong>US$<?php echo number_format($packDetails['prix']); ?></strong></p>
    </form>

    <!-- Ajoutez le bouton de paiement avec un lien vers checkout.php -->
    <a href="checkout.php?idPack=<?php echo $idPack; ?>" id="payment-button" class="styled">Pay</a>

    <!-- Ajoutez un script JavaScript pour gérer le paiement avec Stripe -->
    <script>
        // Initialisez Stripe.js avec votre clé publique
        var stripe = Stripe('votre_clé_publique');

        // Créez un élément de bouton de paiement
        var elements = stripe.elements();
        var style = {
            base: {
                fontSize: '16px',
                color: '#32325d',
            },
        };
        var cardButton = elements.create('cardButton', { style: style });

        // Montrez le bouton de paiement dans le div avec l'identifiant "payment-button"
        cardButton.mount('#payment-button');
    </script>
</body>
</html>

<?php
    } else {
        // Si les détails du pack ne sont pas valides, affichez un message d'erreur
        echo '<p>Invalid Pack Details</p>';
    }
} else {
    // Si l'ID du pack n'est pas valide, affichez un message d'erreur
    echo '<p>Invalid Pack ID</p>';
}
?>
