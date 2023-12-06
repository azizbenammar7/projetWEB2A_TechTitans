<?php

include '../Controller/userC.php';
include '../model/user.php';

$error = "";

// create user
$user = null;

// create an instance of the controller
$userC = new UserC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["role_user"]) &&
    isset($_POST["typeDiabete"]) &&
    isset($_POST["ville"]) &&
    isset($_FILES["diplome"]) &&
    isset($_POST["motdepasse"]) &&
    isset($_FILES["pdp"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["role_user"]) &&
        !empty($_POST["motdepasse"])
    ) {
        // Check if the email already exists
        if ($userC->emailExists($_POST['email'])) {
            $error = "L'adresse e-mail existe déjà. Veuillez choisir une adresse e-mail différente.";
        } else {
            // Vérification et traitement de l'upload du diplôme
            $diplome = null;
            if ($_FILES['diplome']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
                    die('Failed to create upload directory');
                }

                $uploadFile = $uploadDir . basename($_FILES['diplome']['name']);

                if (move_uploaded_file($_FILES['diplome']['tmp_name'], $uploadFile)) {
                    $diplome = $uploadFile;
                } else {
                    $error = "Erreur lors de l'upload du diplôme.";
                }
            }
            $pdp = null;
            if ($_FILES['pdp']['error'] == UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                if (!file_exists($uploadDir) && !mkdir($uploadDir, 0777, true)) {
                    die('Failed to create upload directory');
                }

                $uploadFile = $uploadDir . basename($_FILES['pdp']['name']);

                if (move_uploaded_file($_FILES['pdp']['tmp_name'], $uploadFile)) {
                    $pdp = $uploadFile;
                } else {
                    $error = "Erreur lors de l'upload du photo de profil.";
                }
            }

            $activation_token = bin2hex(random_bytes(16));
            $activation_token_hash = hash("sha256", $activation_token);

            $user = new User(
                null,
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['tel'],
                $_POST['role_user'],
                intval($_POST['typeDiabete']),
                $_POST['ville'],
                $diplome,
                md5($_POST['motdepasse']),
                $pdp,
                $activation_token_hash 
            );
           
            $userC->addUser($user);

            // Send activation email
            $activation_link = "http://localhost/proj_Dia%20-%20Copie%20-%20Copie%20-%20Copie%20-%20Copie/views/activate-account.php?token=$activation_token_hash";
            $subject = "Activer votre compte";
            $message = "Merci de vous être inscrit chez DiaZen ! Cliquez sur le lien suivant pour activer votre compte: $activation_link";
            $headers = "From: noreply@example.com";
            
            mail($_POST['email'], $subject, $message, $headers);
            
            // Redirect to the login page
            header('Location: signup-success.php');
            exit;
        }
    } 
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Styles from the second code -->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">

    <!-- Styles for the login page -->
    <link rel="stylesheet" type="text/css" href="css/style2.css">

    <!-- Script from the second code -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=VOTRE_CLE_API&callback=initMap" async defer></script>

    <!-- Custom script for handling form visibility -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        function updateFormFields() {
            var roleSelect = document.getElementById("role_user");
            var typeDiabeteRow = document.getElementById("typeDiabeteRow");
            var villeRow = document.getElementById("villeRow");
            var diplomeRow = document.getElementById("diplomeRow");

            typeDiabeteRow.style.display = "none";
            villeRow.style.display = "none";
            diplomeRow.style.display = "none";

            if (roleSelect.value === "patient") {
                typeDiabeteRow.style.display = "table-row";
            } else if (roleSelect.value === "medecin" || roleSelect.value === "pharmacien") {
                villeRow.style.display = "table-row";
                diplomeRow.style.display = "table-row";
            }
        }

        function validateName(input) {
            // Validate that the name contains only letters
            var regex = /^[a-zA-Z ]+$/;
            return regex.test(input);
        }

        function validateEmail(email) {
            // Validate email structure
            var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function validateTelephone(telephone) {
            // Validate that the telephone contains only 8 digits
            var regex = /^[0-9]{8}$/;
            return regex.test(telephone);
        }

        var roleSelect = document.getElementById("role_user");
        var nomInput = document.getElementById("nom");
        var prenomInput = document.getElementById("prenom");
        var emailInput = document.getElementById("email");
        var telephoneInput = document.getElementById("telephone");

        roleSelect.addEventListener("change", updateFormFields);

        updateFormFields();

        var form = document.querySelector("form");
        form.addEventListener("submit", function (event) {
            var isValid = true;

            if (!validateName(nomInput.value)) {
    isValid = false;
    alert("Le nom doit contenir uniquement des lettres et des espaces.");
}

if (!validateName(prenomInput.value)) {
    isValid = false;
    alert("Le prénom doit contenir uniquement des lettres et des espaces.");
}
            if (!validateEmail(emailInput.value)) {
                isValid = false;
                alert("Veuillez entrer une adresse e-mail valide.");
            }

            if (!validateTelephone(telephoneInput.value)) {
                isValid = false;
                alert("Le numéro de téléphone doit contenir exactement 8 chiffres.");
            }

            if (!isValid) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    });
</script>
</head>
<style>
    /* Add this style to position the error message */
    
    /* Updated style to position the error message at the top left */
    .error-message {
        position: fixed;
        top: 10px;
        left: 10px;  /* Change 'right' to 'left' */
        background-color: #ffdddd;
        padding: 10px;
        border: 1px solid #f00;
        border-radius: 5px;
        display: <?php echo empty($error) ? 'none' : 'block'; ?>;
    }

</style>
<body>
<img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/Tiny_doctors_with_glucometer_flat_vector_illustration-removebg-preview (1).png">
        </div>
        <div class="login-content">
            <form action="" method="POST" enctype="multipart/form-data">
                <h2 class="title">S'inscrire</h2>
                <p class="mb-4">Rejoignez notre communauté dédiée à la santé en tant que médecin, pharmacien ou patient, et profitez des avantages exclusifs de DiaZen dès maintenant !</p>
                <br>
               <!-- Form inputs and fields (your original form) -->
<table>
    <tr>
        <td><label for="nom">Nom :</label></td>
        <td>
            <input type="text" id="nom" name="nom" />
        </td>
    </tr>
    <tr>
        <td><label for="prenom">Prénom :</label></td>
        <td>
            <input type="text" id="prenom" name="prenom" />
        </td>
    </tr>
    <tr id="pdpRow">
        <td><label for="pdp">photo de profil :</label></td>
        <td>
            <input type="file" name="pdp" />
            <span id="erreurPdp" style="color: red"></span>
        </td>
    </tr>
    <tr>
        <td><label for="email">Email :</label></td>
        <td>
            <input type="text" id="email" name="email" />
        </td>
    </tr>
    <tr>
        <td><label for="motdepasse">Mot de passe :</label></td>
        <td><input  id="motdepasse" name="motdepasse" /></td>
    </tr>
    <tr>
        <td><label for="telephone">Téléphone :</label></td>
        <td>
            <input type="text" id="telephone" name="tel" />
        </td>
    </tr>
    <tr>
        <td><label for="role_user">Role User :</label></td>
        <td>
            <select id="role_user" name="role_user">
                <option value="patient">Patient</option>
                <option value="medecin">Médecin</option>
                <option value="pharmacien">Pharmacien</option>
            </select>
        </td>
    </tr>
    <tr id="typeDiabeteRow">
        <td><label for="typeDiabete">Type Diabète :</label></td>
        <td>
            <select id="typeDiabete" name="typeDiabete">
                <option value="NonConcerne" selected>Non concerné</option>
                <option value="1">Type 1</option>
                <option value="2">Type 2</option>
            </select>
        </td>
    </tr>
    <tr id="villeRow">
        <td><label for="ville">Ville :</label></td>
        <td>
            <select id="ville" name="ville">
                <option value="NonConcerne" selected>Non concerné</option>
                <option value="Tunis">Tunis</option>
                <option value="Mannouba">Mannouba</option>
                <option value="Ariana">Ariana</option>
                <option value="BenArous">Ben Arous</option>
            </select>
        </td>
    </tr>
    <tr id="diplomeRow">
        <td><label for="diplome">Diplôme :</label></td>
        <td>
            <input type="file" name="diplome" />
            <span id="erreurDiplome" style="color: red"></span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center;">
            <input type="submit" class="btn" value="save" id="submitButton">
        </td>
        
    </tr>
</table>


                <script>
                    const roleSelect = document.getElementById('role_user');
                    const patientFields = document.getElementById('patient_fields');
                    const medecinFields = document.getElementById('medecin_fields');
                    const pharmacienFields = document.getElementById('pharmacien_fields');
                    const typeDiabeteSelect = document.getElementById('typeDiabete');

                    roleSelect.addEventListener('change', function () {
                        const selectedRole = roleSelect.value;

                        // Réinitialisez la visibilité de tous les champs
                        patientFields.style.display = 'none';
                        medecinFields.style.display = 'none';
                        pharmacienFields.style.display = 'none';

                        // Affichez les champs en fonction du rôle sélectionné
                        if (selectedRole === 'patient') {
                            patientFields.style.display = 'block';
                        } else if (selectedRole === 'medecin') {
                            medecinFields.style.display = 'block';
                        } else if (selectedRole === 'pharmacien') {
                            pharmacienFields.style.display = 'block';
                        }
                    });
                </script>
                
            </form>
        </div>
    </div>
    <div class="error-message">
        <?php echo $error; ?>
    </div>
</body>

</html>
