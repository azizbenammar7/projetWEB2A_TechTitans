<?php

include '../controller/commentaireC.php';
include '../model/commentaire.php';

$error = "";

// create reclamation
$commentaire = null;
// create an instance of the controller
$commentaireC= new commentaireC();

if (
    isset($_POST["publication"]) &&
    isset($_POST["text_of_commentaire"]) 
) {
    if (
        !empty($_POST['publication']) &&
        !empty($_POST["text_of_commentaire"]) 
    ) {
        $commentaire = new commentaire(
            $_POST['IDcommentaire'],
            $_POST['publication'],
            $_POST['text_of_commentaire']
        );

        $commentaireC->updateCommentaire($commentaire, $_POST['IDcommentaire']);

        header('Location:listcommentaire.php');
        
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
    <title>commentaire Update</title>
</head>

<body>
    <button><a href="listcommentaire.php">Back to list</a></button>
    
    <hr>

    <div id="error">
        <?php echo $error; ?>
    </div>

    <?php
    if (isset($_POST['IDcommentaire'])) {
        
        $commentaire = $commentaireC->showCommentaire($_POST['IDcommentaire']);
    ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="IDcommentaire">Id commentaire :</label></td>
                    <td>
                        <input type="text" id="IDcommentaire" name="IDcommentaire" value="<?php echo $_POST['IDcommentaire'] ?>" readonly />
                        <span id="erreurIDcommentaire" style="color: red"></span>
                    </td>
                </tr>
                
            
  
                <tr>
                <label for="publication">publication :</label>
                <input type="number" id="publication" name="publication" value="<?php echo $commentaire['publication']; ?>">
                
                </tr>
                <tr>
                    <td><label for="text_of_commentaire">text of commentaire :</label></td>
                    <td>
                    <textarea id="text_of_commentaire" name="text_of_commentaire"><?php echo $commentaire['text_of_commentaire'] ?></textarea>
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