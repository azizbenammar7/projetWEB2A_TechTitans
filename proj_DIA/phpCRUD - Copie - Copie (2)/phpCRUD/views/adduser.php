<?php

include '../Controller/userC.php';
include '../model/user.php';

$error = "";

// create client
$user = null;

// create an instance of the controller
$userC = new userC();
if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["tel"])
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["tel"])
    ) {
        $user = new user(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['tel'],
            
        );
        $user->setRole($_POST['role']);

        $userC->adduser($user);
        header('Location:listusers.php');
    } else
        $error = "Missing information";
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user </title>

    <script>
        function validateForm() {
            var nom = document.getElementById("nom").value;
            var prenom = document.getElementById("prenom").value;
            var email = document.getElementById("email").value;
            var telephone = document.getElementById("telephone").value;

            var erreurNom = document.getElementById("erreurNom");
            var erreurPrenom = document.getElementById("erreurPrenom");
            var erreurEmail = document.getElementById("erreurEmail");
            var erreurTelephone = document.getElementById("erreurTelephone");

            var isValid = true;

            // Validation pour le champ Nom
            if (nom == "") {
                erreurNom.innerHTML = "Veuillez saisir votre nom.";
                isValid = false;
            } else {
                erreurNom.innerHTML = "";
            }

            // Validation pour le champ Prénom
            if (prenom == "") {
                erreurPrenom.innerHTML = "Veuillez saisir votre prénom.";
                isValid = false;
            } else {
                erreurPrenom.innerHTML = "";
            }

            // Validation pour le champ Email
            if (email == "") {
                erreurEmail.innerHTML = "Veuillez saisir votre email.";
                isValid = false;
            } else {
                erreurEmail.innerHTML = "";
            }

            // Validation pour le champ Téléphone
            if (telephone == "") {
                erreurTelephone.innerHTML = "Veuillez saisir votre numéro de téléphone.";
                isValid = false;
            } else {
                erreurTelephone.innerHTML = "";
            }

            return isValid;
        }
    </script>
</head>

<body>
    <a href="listusers.php">Back to list </a>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <form action="" method="POST" onsubmit="return validateForm()">
        <table>
            <tr>
                <td><label for="nom">Nom :</label></td>
                <td>
                    <input type="text" id="nom" name="nom" />
                    <span id="erreurNom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="prenom">Prénom :</label></td>
                <td>
                    <input type="text" id="prenom" name="prenom" />
                    <span id="erreurPrenom" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email :</label></td>
                <td>
                    <input type="text" id="email" name="email" />
                    <span id="erreurEmail" style="color: red"></span>
                </td>
            </tr>
            <tr>
                <td><label for="telephone">Téléphone :</label></td>
                <td>
                    <input type="text" id="telephone" name="tel" />
                    <span id="erreurTelephone" style="color: red"></span>
                </td>
            </tr>
            <tr>
    <td><label for="role">Role:</label></td>
    <td>
        <select id="role" name="role">
            <option value="patient">Patient</option>
            <option value="medecin">Medecin</option>
            <option value="pharmacien">Pharmacien</option>
        </select>
        <?php if ($_POST['role'] == 'medecin') { ?>
    <tr>
        <td><label for="diplome_id">Diplôme ID :</label></td>
        <td><input type="text" id="diplome_id" name="diplome_id" /></td>
    </tr>
<?php } elseif ($_POST['role'] == 'pharmacien') { ?>
    <tr>
        <td><label for="CIN">CIN :</label></td>
        <td><input type="text" id="CIN" name="CIN" /></td>
    </tr>
<?php } ?>
<?php if ($_POST['role'] == 'patient') { ?>
    <tr>
        <td><label for="type_diabete">Type de diabète :</label></td>
        <td>
            <select id="type_diabete" name="type_diabete">
                <option value="1">Type 1</option>
                <option value="2">Type 2</option>
            </select>
        </td>
    </tr>
<?php } ?>

    </td>
</tr>

            <tr>
                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>