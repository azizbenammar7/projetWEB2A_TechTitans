<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Rubik', sans-serif; /* Utilisation de la police Rubik */
            margin: 20px;
        }
        header {
            text-align: center;
        }
        header img {
            position: absolute;
            top: -50px;
            right:-40px;
            max-width: 350px; /* Ajustez la largeur selon vos besoins */
            max-height:350px ; /* Ajustez la hauteur selon vos besoins */
        }
        footer {
            text-align: center;
            font-style: italic;
            margin-top: 20px;
        }
        img#contact-img {
            position: absolute;
            bottom: 20px;
            right: -80px;
            max-width: 400px; /* Ajustez la largeur selon vos besoins */
            max-height: 400px; /* Ajustez la hauteur selon vos besoins */
        }
        img#cachet-medecin {
            max-width: 200px; /* Ajustez la largeur selon vos besoins */
            max-height: 200px; /* Ajustez la hauteur selon vos besoins */
        }
    </style>
</head>
<body>
    
    <img src="diazen.png" alt="Logo">
    
    <header>
    <img src="zina.png" alt="Zina's Photo" />
        <h1>Ordonnance Médicale</h1>
        <p><strong>Nom du patient: </strong>{{ nom_patient }}</p>
    </header>

    <section>
        <h2>Médicaments Prescrits</h2>
        <ul>
            <li><strong>Nom du médicament:</strong> {{ medicament }} - <strong>dosage:</strong> {{ quantite }}</li>
            <!-- Ajoutez d'autres lignes si nécessaire -->
        </ul>
    </section>
    
    <footer>
    Instructions:
- Prendre les médicaments comme prescrit.
- Suivre les instructions du médecin.
- En cas d'effets secondaires, contactez immédiatement votre médecin.    </footer>
    <img id="contact-img" src="contact.png" alt="Contact Image">
    <p><strong>Nom du médecin: </strong>{{ nom_medecin }}</p>
    <img id="cachet-medecin" src="{{ cachet_medecin }}" alt="Cachet du médecin">

</body>
</html>
