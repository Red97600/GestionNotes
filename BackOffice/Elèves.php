<?php
$mysqlClient = new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8', 'root', '');

$tbclas=[];
$clas=$mysqlClient->prepare('SELECT * FROM `classes` ORDER BY `classes`.`Nom_Classe` ASC');
$clas->execute();
$tbclas=$clas->fetchAll();

if (isset($_GET['ajouter']) && !empty($_GET['Prenom']) && !empty($_GET['Nom']) && !empty($_GET['Id']))
{
    $pr=$_GET['Prenom'];
    $nm=$_GET['Nom'];
    $cl=$_GET['Id'];

    $inser=$mysqlClient->prepare('INSERT INTO eleves (Nom,Prenom,Id_Classe) VALUES (:Nom,:Prenom,:Id_Classe)');
    $inser->execute ([   
        'Nom'=> $nm,
        'Prenom'=> $pr,
        'Id_Classe'=> $cl 
    ]);  
}

// SUPPRiMER
if (isset($_POST['Suprimer'])) 
    {
        $idsup = (int)$_POST['Suprimer'];
        $delet = $mysqlClient->prepare('DELETE FROM eleves WHERE `eleves`.`Id` = :Id');
        $delet->execute(['Id' => $idsup]);
        
    }


//affiche
$elv=[];
$il=$mysqlClient->prepare
('SELECT eleves.Id,eleves.Nom,eleves.Prenom,classes.Nom_Classe FROM eleves JOIN classes ON eleves.Id_Classe = classes.Id;
');
$il->execute();
$elv=$il->fetchall();



?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>page sur les note des eleves.</title>
</head>
<body>
    <h1>Back-Office- Classes</h1>
    <nav>
        <a href="Dashboard.php">Dashboard</a>
        <a href="Classes.php">Classes</a>
        <a href="Elèves.php">Elèves</a>
        <a href="Matières.php">Matières</a>
        <a href="Notes.php">Notes</a>
    </nav>
    <h1>Back-Office- eleves</h1>

    <h2>Ajouter un eleve </h2>

    <table >
    <tr>
    <td>
    <nav>
        <form action="" method="GET">

        <label for="Prenom">prenom :</label>
        <input type="text" required name="Prenom" placeholder="ecrie le prenom">

        <label for="Nom">Nom:</label>
        <input type="text" required name="Nom" placeholder="ecrie le Nom">
        
        <label for="Id"> classes : </label>
        <select name="Id" required id="Id">
            <option value="">choisissez la classe</option>
            <?php        
                for ($i=0; $i <count($tbclas) ; $i++) 
                { 
                    echo '<option value="'.$tbclas[$i]['Id'].'">'.$tbclas[$i]['Nom_Classe'].'</option>';
                }; 
            ?>          
        </select>

        <button type="submit" name="ajouter">Ajouter</button>
        </form>   
    </nav>
     </td>
 </table>

 <?php 


        for ($i=0; $i <count($elv) ; $i++)  
                {   
                        
                                      
            echo '<p> Voiçi  les notes de </p>';

                        echo "<table border = '1'>";
                        echo "<tr>
                            <th>Id</th>
                            <th>Prenom</th>
                            <th>Nom</th>
                            <th>Classes</th>
                                <th>ACTION</th>
                            
                            </tr>";

            for ($i=0; $i <count($elv) ; $i++)  
            {   

            echo "<tr>";
                echo "<td>".$elv[$i]['Id']."</td>";
                echo "<td>".$elv[$i]['Nom']."</td>";
                echo "<td>".$elv[$i]['Prenom']."</td>";
                echo "<td>".$elv[$i]['Nom_Classe']."</td>";
                echo '<td>
            <form method="POST" action="editelv.php">
             <button type="submit" name="Id" value="'.$elv[$i]['Id'].'">Modiffier</button>
            </form>
            <form method="POST" action="Elèves.php">
                <button type="submit" name="Suprimer" value="'.$elv[$i]['Id'].'">Supprimer</button>
            </form>
            </td>';
           
              
            echo "</tr>";
           }           
        }

?>  


</body>
</html>
