<?php
$mysqlClient = new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8', 'root', '');
//---------------------------------------------------------------------------------------------------------



if (isset($_GET['ajouter']) && !empty($_GET['Nom_Matiere']))
{
    $mn=$_GET['Nom_Matiere'];
    $insert=$mysqlClient->prepare('INSERT INTO matieres (Nom_Matiere) VALUES (:Nom_Matiere)');
    $insert->execute ([ 'Nom_Matiere'=> $mn, ]); 
}







//------------------------------------------------------------------------------------------------------------
$nm=$mysqlClient->prepare('SELECT Id, Nom_Matiere FROM matieres');
$nm->execute();
$tabnm=$nm->fetchAll()
?>






<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page sur les note des eleves.</title>
       
    </head>
    <body>
        <h1>Back-Office- notes</h1>
        <nav>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Classes.php">Classes</a>
            <a href="Elèves.php">Elèves</a>
            <a href="Matières.php">Matières</a>
            <a href="Notes.php">Notes</a>
        </nav>

        <nav>
            <!----bouton pour ecrire et envoyer le nom de la matiere -->
              <h2>Nom_martiere</h2>
            <form action="" methode="GET">
             <label for="Nom_Matiere">libellé :</label>
             <input type="text" name="Nom_Matiere" placeholder="ecrie le Nom_martiere">
             <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </nav>

        <nav>
            <p>TABLEAU DE MATIERES</p>
            <table border="1">
                <tr>
                    <th>ID</th>
                     <th>matieres</th>
                     <th>Action</th>
                </tr>
             <?php
             for ($i=0; $i <count($tabnm) ; $i++) 
                { 
                   echo '<tr>';
                   echo '<td>'.$tabnm[$i]['Id'].'</td>';
                   echo '<td>'.$tabnm[$i]['Nom_Matiere'].'</td>';
                   echo '</tr>';
                }





             ?>
          </table>
        </nav>
        
        

    </body>
</html>
