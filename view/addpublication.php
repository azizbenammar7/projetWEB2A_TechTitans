


<?php

ob_start();
include '../view/header.php';
include '../controller/pubC.php';
include '../model/publication.php';

// Initialiser les messages d'erreur pour chaque champ
$errorNom = "";
$errorPrenom = "";
$errorEmail = "";
$errorDatePub = "";
$errorTextOfPub = "";

$publication = null;
$pubC = new pubC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Contrôles de saisie
    if (empty($_POST['nom']) || !preg_match('/^[a-zA-Z ]+$/', $_POST['nom'])) {
        $errorNom = "Le champ 'Nom' est invalide. Il doit se composer uniquement de lettres et d'espaces.";
    }

    if (empty($_POST['prenom']) || !preg_match('/^[a-zA-Z ]+$/', $_POST['prenom'])) {
        $errorPrenom = "Le champ 'Prénom' est invalide. Il doit se composer uniquement de lettres et d'espaces.";
    }

    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errorEmail = "Le champ 'Email' est invalide.";
    }

    // Vérification de la date
    $aujourdHui = date('Y-m-d');
    if (empty($_POST['date_pub']) || $_POST['date_pub'] !== $aujourdHui) {
        $errorDatePub = "Le champ 'Date de publication' doit être la date d'aujourd'hui.";
    }

    if (empty($_POST['text_of_pub']) || !preg_match('/^[a-zA-Z ]+$/', $_POST['text_of_pub']) || strlen($_POST['text_of_pub']) > 500) {
        $errorTextOfPub = "Le champ 'Texte de la publication' est invalide. Il doit se composer uniquement de lettres, d'espaces, et ne pas dépasser 500 caractères.";
    }

    if (empty($errorNom) && empty($errorPrenom) && empty($errorEmail) && empty($errorDatePub) && empty($errorTextOfPub)) {
        // Si aucune erreur, création de la publication
        $publication = new publication(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['role'],
            $_POST['text_of_pub'],
            $_POST['date_pub']
        );
        $pubC->addpublication($publication);
        header('Location:listpublication.php');
    }
}

ob_end_flush();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Publication</title>
</head>

<body>
    <a href="listpublication.php">Back to list</a>
    <hr>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">
                        Créer une publication
                    </p>
                    <h1 class="mb-4">Créer une publication</h1>
                    <p class="mb-4">
                        Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat
                        ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
                    </p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form action="" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="nom" style="height: 55px" id="nom" name="nom" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" />
                                    <?php if (!empty($errorNom)) : ?>
                                        <div style="color: red;"><?php echo $errorNom; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="prénom" style="height: 55px" name="prenom" id="prenom" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>" />
                                    <?php if (!empty($errorPrenom)) : ?>
                                        <div style="color: red;"><?php echo $errorPrenom; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px" id="role" name="role" required>
                                        <option value="" disabled selected>choisir ton role</option>
                                        <option value="moderateur">Modérateur</option>
                                        <option value="pharmacien">Pharmacien</option>
                                        <option value="medecin">Médecin</option>
                                        <option value="patient">Patient</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-row" id="user-email" data-target-input="nearest">
                                        <input type="email" class="form-control border-0 datetimepicker-input" placeholder="Email" data-target="#email" data-toggle="email" style="height: 55px" name="email" />
                                    </div>
                                    <?php if (!empty($errorEmail)) : ?>
                                        <div style="color: red;"><?php echo $errorEmail; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="date" class="form-control border-0 datetimepicker-input" placeholder="Date de la publication" data-target="#date" data-toggle="datetimepicker" style="height: 55px" name="date_pub" />
                                        <?php if (!empty($errorDatePub)) : ?>
                                            <div style="color: red;"><?php echo $errorDatePub; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" rows="5" placeholder="rédiger ton post" name="text_of_pub"><?php echo isset($_POST['text_of_pub']) ? htmlspecialchars($_POST['text_of_pub']) : ''; ?></textarea>
                                    <?php if (!empty($errorTextOfPub)) : ?>
                                        <div style="color: red;"><?php echo $errorTextOfPub; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Publier la publication</button>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="reset">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php include '../view/footer.php' ?>