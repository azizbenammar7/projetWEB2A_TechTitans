<?php
include '../controller/pubC.php';


$pubC = new pubC();
$publications = $pubC->listpublications();  
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    
    $datePubFilter = $_POST["datePubFilter"];
$publications = $pubC->filterPublicationByDate($datePubFilter);

    
}

?>


<html>

<head>
    <title>List of Publications</title>
</head>

<body>
    <h1>List of Publications</h1>
    <h2>
        <a href="addpublication.php">Add Publication</a>
    </h2>

    <div class="row">
        <div class="col-md-12">
            <form method="GET">
                <label for="search">Search</label>
                <input type="text" id="search" name="search" placeholder="Enter ID Publication...">
                <input type="submit" value="Search">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">
                <label for="datePubFilter">Filter by Date:</label>
                <input type="date" name="datePubFilter">
                <input type="submit" value="Apply Filter">
            </form>
        </div>
    </div>

    <table border="1" align="center" width="70%">
        <tr>
            <th>ID Publication</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Role</th>
            <th>Text of Publication</th>
            <th>Date of Publication</th>
            <th>Number of Likes</th> <!-- New column for nbr_like -->
            <th>Number of Dislikes</th> <!-- New column for nbr_dislike -->
            <th>Update</th>
            <th>Delete</th>
        </tr>

        <?php foreach ($publications as $publication) {
            if (isset($_GET['search']) && $_GET['search'] != '' && strpos($publication['IDpub'], $_GET['search']) === false) {
                continue; // Skip this row if it doesn't match the search criteria
            }
        ?>
            <tr>
                <td><?= $publication['IDpub']; ?></td>
                <td><?= $publication['nom']; ?></td>
                <td><?= $publication['prenom']; ?></td>
                <td><?= $publication['email']; ?></td>
                <td><?= $publication['role']; ?></td>
                <td><?= $publication['text_of_pub']; ?></td>
                <td><?= $publication['date_pub']; ?></td>
                <td><?= $publication['nbr_like']; ?></td> <!-- Display nbr_like -->
                <td><?= $publication['nbr_dislike']; ?></td> <!-- Display nbr_dislike -->
                <td align="center">
                    <form method="POST" action="update_pub.php">
                        <input class="update-button" type="submit" name="update" value="Update">
                        <input type="hidden" value="<?= $publication['IDpub']; ?>" name="IDpublication">
                    </form>
                </td>
                <td>
                    <a class="delete-button" href="delete_pub.php?IDpublication=<?= $publication['IDpub']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .delete-button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }

        .update-button {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            padding: 5px 10px;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style for search and filter forms */
        form {
            margin-bottom: 10px;
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        label {
            margin-right: 10px;
        }

        input[type="text"],
        input[type="date"] {
            padding: 5px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
