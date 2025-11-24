 <?php

$mysqlClient=new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8','root','');


$eleve=[];
$sl=$mysqlClient->prepare
('SELECT eleves.Id, eleves.Nom, eleves.Prenom, classes.Nom_Classe, matieres.Nom_Matiere, notes.Note,notes.Date 
FROM eleves
LEFT JOIN notes ON eleves.Id = notes.Id_Eleve 
LEFT JOIN matieres ON notes.Id_Matiere = matieres.Id 
JOIN classes ON classes.Id = eleves.Id_Classe;
');
$sl->execute();
$eleve=$sl->fetchall();

?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>page sur les note des eleves.</title>

    </head>
    <body>
       <nav>
         <ul>
             <li>
                <a href="index.php">acceuil</a>
             </li>
             <li>
                <a href="note.php">Note des élèves</a>
             </li>
           
       </nav>
       <ul><p>
                    <form method="GET" action="">
                <label for="Id">Veillez selectionnez l'élève que vous souhaitez voir ses notes :</label>
            <select name="Id" id="Id"placeholder="Modifier la classe">
             
             <option value="">choisiz le nom d'un eleves  </option>
                      <?php     
                            
                            for ($i='0'; $i <count($eleve) ; $i++) 
                            { 
                                echo '<option value='.$eleve[$i]['Id'].'>'.$eleve[$i]['Nom'].' '.$eleve[$i]['Prenom'].'</option>';
                            }; 
                        ?>
                        
            </select>
            <button type="submit">afficher</button>
            </form>

            </p>
              <?php 


    for ($i=0; $i <count($eleve) ; $i++)  
            {    if(isset($_GET['Id']))
                    {
                        if ($eleve[$i]['Note'] == NULL) {
                            echo "L'élève ".$eleve[$i]['Prenom'].' '.$eleve[$i]['Nom']." n’a pas de note.";
                        } else {
                            if ($eleve[$i]['Id'] == $_GET['Id'] )
                                    {   
                                        
                                    echo '<p> Voiçi  les notes de '.$eleve[$i]['Prenom'].' '.$eleve[$i]['Nom'].'</p>';

                                                echo "<table border='1'>";
                                                echo "<tr>
                                                    <th>Classe</th>
                                                    <th>Matière</th>
                                                    <th>Note</th>
                                                    <th>Date</th>
                                                    
                                                    </tr>";

                                    for ($i=0; $i <count($eleve) ; $i++)  
                                    {    if(isset($_GET['Id']))
                                            {
                                                if ($eleve[$i]['Id'] == $_GET['Id'] )
                                                {   
                                                


                                                    echo "<tr>";
                                                        echo "<td>".$eleve[$i]['Nom_Classe']."</td>";
                                                        echo "<td>".$eleve[$i]['Nom_Matiere']."</td>";
                                                        echo "<td>".$eleve[$i]['Note']."</td>";
                                                        echo "<td>".$eleve[$i]['Date']."</td>";
                                                    echo "</tr>";

                                                }         
                                                
                                            }
                                        }   
                                    }         
                        }
                            
                                    
                    }
                } 
        
            
 ?>       
    </ul>


    </body>
</html>


