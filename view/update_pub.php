<?php

include '../Controller/PubC.php';
include '../model/publication.php';
$error = "";

// create publication
$publication = null;

// create an instance of the controller
$pubC = new PubC();

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
        foreach ($_POST as $key => $value) {
            echo "Key: $key, Value: $value<br>";
        }

        $publication = new publication(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['role'],
            $_POST['text_of_pub'],
            $_POST['date_pub']
        );
        var_dump($publication);

        $pubC->updatePublication($publication, $_POST['IDpub']);

        header('Location:listpublication.php');
    } else
        $error = "Missing information";
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication Display</title>
</head>

<body>
    <button><a href="listpublication.php">Back to list</a></button>
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['idPublication'])) {
        $publication = $pubC->showPublication($_POST['idPublication']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="idPublication">ID Publication :</label></td>
                    <td>
                        <input type="text" id="idPublication" name="idPublication" value="<?php echo $_POST['IDpub'] ?>" readonly />
                        <span id="erreurIdPublication" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $publication['nom'] ?>" />
                        <span id="erreurNom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="prenom">Prénom :</label></td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $publication['prenom'] ?>" />
                        <span id="erreurPrenom" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email :</label></td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $publication['email'] ?>" />
                        <span id="erreurEmail" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="role">Role :</label></td>
                    <td>
                        <input type="text" id="role" name="role" value="<?php echo $publication['role'] ?>" />
                        <span id="erreurRole" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="text_of_pub">Text of Publication :</label></td>
                    <td>
                        <input type="text" id="text_of_pub" name="text_of_pub" value="<?php echo $publication['text_of_pub'] ?>" />
                        <span id="erreurText_of_pub" style="color: red"></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="date_pub">Date de Publication :</label></td>
                    <td>
                        <input type="text" id="date_pub" name="date_pub" value="<?php echo $publication['date_pub'] ?>" />
                        <span id="erreurDate_pub" style="color: red"></span>
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
