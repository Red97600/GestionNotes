<?php
$mysqlClient = new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8', 'root', '');

// AJOUTER
if (isset($_POST['ajouter']) && !empty($_POST['Nom_Classe'])) 
    {
        $nclas = trim($_POST['Nom_Classe']);
        $inser = $mysqlClient->prepare('INSERT INTO classes (Nom_Classe) VALUES (:Nom_Classe)');
        $inser->execute(['Nom_Classe' => $nclas]);
        header("Location: classes.php"); 
        exit;
    }

// SUPPRiMER
if (isset($_POST['Suprimer'])) 
    {
        $idSup = (int)$_POST['Suprimer'];
        $delete = $mysqlClient->prepare('DELETE FROM classes WHERE Id = :Id');
        $delete->execute(['Id' => $idSup]);
        header("Location: classes.php"); 
        exit;
    }

// AFFICHE
    $cl = $mysqlClient->prepare('SELECT `Id`, `Nom_Classe` FROM `classes`');
    $cl->execute();
    $classe = $cl->fetchAll();


?>

<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8" />
   <title>Back-Office Classes</title>
  </head>
<body>
   <h1>Back-Office-Classes</h1>
   <nav>
        <a href="Dashboard.php">Dashboard</a>
        <a href="Classes.php">Classes</a>
        <a href="Elèves.php">Elèves</a>
        <a href="Matières.php">Matières</a>
        <a href="Notes.php">Notes</a>
   </nav>

     <h2>Ajouter une classe</h2>
     <form action="" method="POST">
        <label for="Nom_Classe">Libellé :</label>
        <input type="text" name="Nom_Classe" placeholder="ajoute une classe">
        <button type="submit" name="ajouter">Ajouter</button>
     </form>

    <h2>Liste des classes</h2>
    <table border="1">
     <tr><th>Id</th><th>Libellé</th><th>Actions</th></tr>
 <?php
        for ($i=0; $i<count($classe); $i++) {
            echo '<tr>';
            echo '<td>'.$classe[$i]['Id'].'</td>';
            echo '<td>'.htmlspecialchars($classe[$i]['Nom_Classe']).'</td>';
            echo '<td>
            <form method="POST" action="editer.php">
                <button type="submit" name="Id" value="'.$classe[$i]['Id'].'">Editer </button>
            </form>

            <form method="POST" action="classes.php">
                <button type="submit" name="Suprimer" value="'.$classe[$i]['Id'].'">Supprimer</button>
            </form>
            </td>';
            echo '</tr>';
        }
?>
</table>
</body>
</html>
