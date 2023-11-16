<?php
include '../controller/pubC.php';
include '../model/publication.php';

$error = "";

$publication = null;
$pubC= new pubC();


if (isset($_POST['nom'])&&
isset($_POST['prenom'])&&
isset($_POST['email'])&&
isset($_POST['role'])&&
isset($_POST['text_of_pub'])&&
isset($_POST['date_pub']))
{
    if (!empty($_POST['nom']) && 
    !empty($_POST['prenom']) && 
    !empty($_POST['email']) && 
    !empty($_POST['role']) && 
    !empty($_POST['text_of_pub']) && 
    !empty($_POST['date_pub']))
    {
        $publication = new publication(
            null,
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],    
            $_POST['role'],
            $_POST['text_of_pub'],
            $_POST['date_pub']                                                                                                                                                                                               
        );
        $pubC -> addpublication($publication);
        header('Location:listpublication.php');
    }
    else
    {
        $erreur="missing information";

    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Publication</title>
</head>

    <!-- Forum Start -->
    <body>
    <a href="listpublication.php">Back to list</a>
    <hr>


    <div id="error">
        <?php echo $error; ?>
    </div>


      <div class="container-xxl py-5">
        <div class="container">
          <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
              <p class="d-inline-block border rounded-pill py-1 px-4">
                Créer une publication
              </p>
              <h1 class="mb-4">Créer une publication</h1>
              <p class="mb-4">
                Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                sed stet lorem sit clita duo justo magna dolore erat amet
              </p>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
              <div class="bg-light rounded h-100 d-flex align-items-center p-5">
              <form action="" method="POST">
    <div class="row g-3">
        <div class="col-12 col-sm-6">
            <input type="text" class="form-control border-0" placeholder="nom" style="height: 55px" id="nom" name="nom" />
        </div>
        <div class="col-12 col-sm-6">
            <input type="text" class="form-control border-0" placeholder="prénom" style="height: 55px" name="prenom" id="prenom" />
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
        </div>
        <div class="col-12 col-sm-6">
            <div class="date" id="date" data-target-input="nearest">
                <input type="date" class="form-control border-0 datetimepicker-input" placeholder="Date de la publication" data-target="#date" data-toggle="datetimepicker" style="height: 55px" name="date_pub" />
            </div>
        </div>
        <div class="col-12">
            <textarea class="form-control border-0" rows="5" placeholder="rédiger ton post" name="text_of_pub"></textarea>
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Publier la publication</button>
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