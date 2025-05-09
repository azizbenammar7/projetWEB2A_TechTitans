


<?php

include '../controller/pubC.php';
include '../model/publication.php';

$error = "";

// create reclamation
$publication = null;
// create an instance of the controller
$pubC = new pubC();

if (
    isset($_POST["nom"]) &&
    isset($_POST["prenom"]) &&
    isset($_POST["email"]) &&
    isset($_POST["role"]) &&
    isset($_POST["text_of_pub"]) &&
    isset($_POST["date_pub"]) 
) {
    if (
        !empty($_POST['nom']) &&
        !empty($_POST["prenom"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["role"]) &&
        !empty($_POST["text_of_pub"]) &&
        !empty($_POST["date_pub"]) 
    ) {
        $publication = new publication(
            $_POST['IDpub'],
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['role'],
            $_POST['text_of_pub'],
            $_POST['date_pub']
        );

        $pubC->updatePublication($publication, $_POST['IDpublication']);

        header('Location:listpublication.php');
        print_r("$_POST");
        exit(); // Assurez-vous de quitter l'exécution après la redirection
    } else {
        $error = "Missing information";
    }
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication Update</title>
</head>

<body>
    <button><a href="listpublication.php">Back to list</a></button>
    
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['IDpublication'])) {
        
        $publication = $pubC->showPublication($_POST['IDpublication']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="IDpub">Id publication :</label></td>
                    <td>
                        <input type="text" id="IDpublication" name="IDpublication" value="<?php echo $_POST['IDpublication'] ?>" readonly />
                        <span id="erreurIDpub" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $publication['nom'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">prenom :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $publication['prenom'] ?>" />
                        <span id="erreurPrenom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?php echo $publication['email'] ?>" />
                        <span id="erreurEmail" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="role">Role :</label></td>
                    <td>
                        <select  id="role" name="role" value="<?php echo $publication['role'] ?>"  required>
                          <option value="" disabled selected>choisir ton role</option>
                          <option value="moderateur">Modérateur</option>
                          <option value="pharmacien">Pharmacien</option>
                          <option value="medecin">Médecin</option>
                          <option value="patient">Patient</option>
                        </select>

                        <span id="erreurRole" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_pub">date of publication :</label></td>
                    <td>
                        <input type="date" id="date_pub" name="date_pub" value="<?php echo $publication['date_pub'] ?>" />
                        <span id="erreurEtat" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="text_of_pub">text of publication :</label></td>
                    <td>
                    <textarea id="text_of_pub" name="text_of_pub"><?php echo $publication['text_of_pub'] ?></textarea>
                        <span id="erreurText" style="color: red"></span>
                    </td>
                </tr>


                <td>
                    <input type="submit" value="Save">
                </td>
                <td>
                    <input type="reset" value="Reset">
                </td>
            </table>

        </form>
    <?php
    }
    ?>
</body>

</html>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 15px;
    text-decoration: none;
    cursor: pointer;
}

button a {
    color: #fff;
    text-decoration: none;
}

hr {
    margin-top: 20px;
}

#error {
    color: red;
    margin-bottom: 20px;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
}

td {
    padding: 10px;
}

input[type="text"],
input[type="email"],
input[type="date"],
select,
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    height: 100px;
}

input[type="submit"],
input[type="reset"] {
    background-color: #4caf50;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 4px;
}

input[type="submit"]:hover,
input[type="reset"]:hover {
    background-color: #45a049;
}
</style>