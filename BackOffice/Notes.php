<?php
$mysqlClient = new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8', 'root', '');




$nt=$mysqlClient->prepare('SELECT notes.Id,eleves.Nom,eleves.Prenom,matieres.Nom_Matiere,notes.Note,notes.Date FROM notes JOIN eleves ON eleves.Id = notes.Id_Eleve JOIN matieres ON matieres.Id = notes.Id_Matiere;');
$nt->execute();
$tabnte=$nt->fetchAll();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page sur les note des eleves.</title>
       
    </head>
    <body>
        <h1>Back-Office- notes</h1>
        <nv>
            <a href="Dashboard.php">Dashboard</a>
            <a href="Classes.php">Classes</a>
            <a href="Elèves.php">Elèves</a>
            <a href="Matières.php">Matières</a>
            <a href="Notes.php">Notes</a>
        </nav>


        <h2>Liste des notes des élèves</h2>
        <table border="1">
            <tr><th>Id</th><th>eleves</th><th>Matière</th><th>Note</th><th>Date</th><th>Action</th></tr>
            <?php
                for ($i=0; $i<count($tabnte); $i++) {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($tabnte[$i]['Id']).'</td>';
                    echo '<td>'.htmlspecialchars($tabnte[$i]['Nom']).' '.htmlspecialchars($tabnte[$i]['Prenom']).'</td>';
                    echo '<td>'.htmlspecialchars($tabnte[$i]['Nom_Matiere']).'</td>';
                    echo '<td>'.htmlspecialchars($tabnte[$i]['Note']).'</td>';
                    echo '<td>'.htmlspecialchars($tabnte[$i]['Date']).'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
  
        

    </body>
</html>



