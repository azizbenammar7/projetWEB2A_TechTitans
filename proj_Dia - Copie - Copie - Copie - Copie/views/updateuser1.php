<?php
session_start();

include '../controller/UserC.php';
include '../model/User.php';

$error = "";

// Créez une instance du contrôleur
$userC = new UserC();

// Créez une instance de la classe User
$user = null;
$user = $_SESSION['user_details'];

// Vérifiez si le formulaire a été soumis
if (
    isset($_POST["idUser"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"]) &&
    isset($_POST["role_user"]) &&
    isset($_POST["typeDiabete"]) &&
    isset($_POST["ville"])
) {
    // Vérifiez si des champs obligatoires sont vides
    if (
        !empty($_POST["nom"]) &&
        !empty($_POST['prenom']) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"]) &&
        !empty($_POST["role_user"]) &&
        !empty($_POST["typeDiabete"]) &&
        !empty($_POST["ville"])
    ) {
        // Récupérez les valeurs du formulaire
        $idUser = $_POST['idUser']; // Garder l'ID d'origine
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $roleUser = $_POST['role_user'];
        $typeDiabete = $_POST['typeDiabete'];
        $ville = $_POST['ville'];
        $motdepasse = isset($_POST['motdepasse']) ? md5($_POST['motdepasse']) : null;


        // Vérifiez si une nouvelle pièce jointe a été fournie
        $newDiplome = null;
        if ($_FILES['new_diplome']['error'] == UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['new_diplome']['name']);

            if (move_uploaded_file($_FILES['new_diplome']['tmp_name'], $uploadFile)) {
                $newDiplome = $uploadFile;
            } else {
                $error = "Erreur lors de l'upload du nouveau diplôme.";
            }
        }

        // Créez une instance de la classe User
        $user = new User(
            $idUser,
            $nom,
            $prenom,
            $email,
            $tel,
            $roleUser,
            $typeDiabete,
            $ville,
            $newDiplome,
            $motdepasse
        );

        // Utilisez le contrôleur pour mettre à jour l'utilisateur
        $userC->updateUser($user, $idUser);
        $_SESSION['user_details'] = $user;

        // Redirigez directement vers la liste des utilisateurs
        header('Location: dashboard.php');
        exit(); // Assurez-vous de quitter l'exécution après la redirection
    } else {
        $error = "Veuillez renseigner tous les champs obligatoires.";
    }
}

// Récupérez les informations de l'utilisateur à afficher dans le formulaire
if (isset($_POST['idUser'])) {
    $user = $userC->showUser($_POST['idUser']);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>

    <!-- Styles from the first and second codes -->
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style2.css">

    <!-- Scripts from the first and second codes -->
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=VOTRE_CLE_API&callback=initMap" async defer></script>

    <!-- Custom script for handling form visibility from the first code -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // ... (rest of the script from the first code)
        });
    </script>

    <!-- Custom script for handling form visibility from the second code -->
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
        document.getElementById('idUser').addEventListener('input', function () {
        this.value = '<?php echo $user['id']; ?>';
    }); function validateName(input) {
            // Validate that the name contains only letters
            var regex = /^[a-zA-Z]+$/;
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
        var nomInput = document.getElementById("nom");
var prenomInput = document.getElementById("prenom");
var emailInput = document.getElementById("email");
var telephoneInput = document.getElementById("tel"); // Utiliser "tel" au lieu de "telephone"

var form = document.querySelector("form");
form.addEventListener("submit", function (event) {
    var isValid = true;

    if (!validateName(nomInput.value)) {
        isValid = false;
        alert("Le nom doit contenir uniquement des lettres.");
    }

    if (!validateName(prenomInput.value)) {
        isValid = false;
        alert("Le prénom doit contenir uniquement des lettres.");
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
        event.preventDefault(); // Empêcher la soumission du formulaire si la validation échoue
    }
});

    
    </script>
</head>

<<body>
    <img class="wave" src="img/wave.png"> <!-- Adjust the path to your actual location -->

    <div class="container">
        <div class="img">
            <!-- Add the image tag from the second code -->
            <img src="img/update.png">
        </div>

        <div class="login-content">
        <form action="" method="POST" enctype="multipart/form-data">            <h2 class="title">Modifier Votre Profil</h2>
            <p class="mb-4">Personnalisez votre compte en toute simplicité. Mettez à jour vos informations personnelles, ajustez vos préférences et personnalisez votre expérience en ligne selon vos besoins. Explorez et modifiez votre compte avec facilité.</p>
            <br>
    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if ($user) {
    ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <!-- Affichez l'ID (non modifiable) -->
                <tr>
    <td><label for="idUser">Id User :</label></td>
    <td>
        <input type="text" id="idUser" name="idUser" value="<?php echo $user['id']; ?>" />
        <span id="erreurIdUser" style="color: red"></span>
    </td>
</tr>
                <!-- Ajout du champ "nom" -->
                <tr>
    <td><label for="nom">Nom :</label></td>
    <td>
        <input type="text" id="nom" name="nom" value="<?php echo $user['nom']; ?>" />
        <span id="erreurNom" style="color: red"></span>
    </td>
</tr>

<tr>
    <td><label for="prenom">Prénom :</label></td>
    <td>
        <input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom']; ?>" />
        <span id="erreurPrenom" style="color: red"></span>
    </td>
</tr>
<tr>
    <td><label for="email">Email :</label></td>
    <td>
        <input type="text" id="email" name="email" value="<?php echo $user['email']; ?>" />
        <span id="erreurEmail" style="color: red"></span>
    </td>
</tr>
                <tr>
    <td><label for="motdepasse">Mot de passe :</label></td>
    <td>
        <input type="password" id="motdepasse" name="motdepasse" />
        <span id="erreurMotdepasse" style="color: red"></span>
    </td>
</tr>

<tr>
    <td><label for="tel">Téléphone :</label></td>
    <td>
        <input type="text" id="tel" name="tel" value="<?php echo $user['tel']; ?>" />
        <span id="erreurTel" style="color: red"></span>
    </td>
</tr>
                <!-- Ajout du champ "role_user" -->
               
<tr>
    <td><label for="role_user">Rôle User :</label></td>
    <td>
        <select id="role_user" name="role_user">
            <option value="patient" <?php echo ($user['role_user'] == 'patient') ? 'selected' : ''; ?>>Patient</option>
            <option value="medecin" <?php echo ($user['role_user'] == 'medecin') ? 'selected' : ''; ?>>Médecin</option>
            <option value="pharmacien" <?php echo ($user['role_user'] == 'pharmacien') ? 'selected' : ''; ?>>Pharmacien</option>
        </select>
        <span id="erreurRoleUser" style="color: red"></span>
    </td>
</tr>
<tr>
    <td><label for="typeDiabete">Type Diabète :</label></td>
    <td>
        <select id="typeDiabete" name="typeDiabete">
            <option value="1" <?php echo ($user['typeDiabete'] == '1') ? 'selected' : ''; ?>>Type 1</option>
            <option value="2" <?php echo ($user['typeDiabete'] == '2') ? 'selected' : ''; ?>>Type 2</option>
            <option value="nonconcerne" <?php echo ($user['typeDiabete'] == 'nonconcerne') ? 'selected' : ''; ?>>Non Concerne</option>
        </select>
        <span id="erreurTypeDiabete" style="color: red"></span>
    </td>
</tr>
<tr>
    <td><label for="ville">Ville :</label></td>
    <td>
        <select id="ville" name="ville">
            <option value="benarous" <?php echo ($user['ville'] == 'benarous') ? 'selected' : ''; ?>>Ben Arous</option>
            <option value="tunis" <?php echo ($user['ville'] == 'tunis') ? 'selected' : ''; ?>>Tunis</option>
            <option value="ariana" <?php echo ($user['ville'] == 'ariana') ? 'selected' : ''; ?>>Ariana</option>
            <option value="manouba" <?php echo ($user['ville'] == 'manouba') ? 'selected' : ''; ?>>Manouba</option>
            <option value="nonconcerne" <?php echo ($user['ville'] == 'nonconcerne') ? 'selected' : ''; ?>>Non Concerne</option>
        </select>
        <span id="erreurVille" style="color: red"></span>
    </td>
</tr>

                <!-- Ajout du champ "new_diplome" pour le nouveau diplôme -->
                <tr>
                    <td><label for="new_diplome">Nouveau Diplôme :</label></td>
                    <td>
                        <input type="file" id="new_diplome" name="new_diplome" accept="image/*" />
                        <span id="erreurNewDiplome" style="color: red"></span>
                    </td>
                </tr>
                
                <tr>
                
                    <td>
                        <input type="submit" value="Save" class="btn">
                    </td>
                    <td>
                        <input type="reset" value="Reset" class="btn">
                    </td>
                </tr>
            </table>
        </form>

    <?php } ?>

</body>

</html>