<?php
$mysqlClient = new PDO('mysql:host=localhost;dbname=gestionnotes;charset=utf8', 'root', '');
$cl = $mysqlClient->prepare('SELECT Id, Nom_Classe FROM classes');
$cl->execute();
$edit = $cl->fetchAll();


$vr = null;

if (isset($_POST['Id'])) {
    $Id = (int) $_POST['Id'];   // si il a un Id , on le met en int
} else {
    $Id = null;               // sinon, on met garde la variable  vide
}


if ($Id !== null) {
    for ($i=0; $i<count($edit); $i++) {
        if ($edit[$i]['Id'] == $Id) {  // cette ligne va parcourire le tableau et compare tous les Id pour trouver celle qui est equal notre id
            $vr = $i;
            break;
        }
    }
}

if (isset($_POST['Editer']) && isset($_POST['Id']) && !empty($_POST['Id']) && isset($_POST['Nom']) && !empty($_POST['Nom'])&& isset($_POST['Prenom']) && !empty($_POST['Prenom']) && !empty($_POST['Id_Classe']) && isset($_POST['Id_Classe'])) {
    $idlv = (int)$_POST['Id'];
    $nvnlv = trim($_POST['Nom']);
    $nvplv = trim($_POST['Prenom']);
    $nvcslv = ($_POST['Id_Classe']);
    $update = $mysqlClient->prepare('UPDATE eleves SET Nom= :Nom ,Prenom = :Prenom,Id_Classe = :Id_Classe WHERE Id = :Id');
    $update->execute(['Nom' => $nvnlv, 'Id' => $idlv,'Prenom' => $nvplv,'Id_Classe' => $nvcslv]);
    header("Location: Elèves.php"); 
    exit;
}
?> 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Édition eleves</title>
</head>
<body>
<h1>Éditer une eleves</h1>
<form action="" method="POST">
<label for="Nom_Classe">Modifier :</label>
<input type="text" name="Nom_Classe" placeholder="Modifier la classe" value="<?php echo $vr !== null ? htmlspecialchars($edit[$vr]['Nom_Classe']) : ''; ?>">
<button type="submit" name="Editer">Editer</button>
<?php if ($Id !== null): ?><input type="hidden" name="Id" value="<?php echo $Id; ?>"><?php endif; ?>
</form>
<form action="" method="POST">

        <label for="Prenom">edt.prenom :</label>
        <input type="text" required name="Prenom" placeholder="Modifier le prenom" value="<?php echo $nr !== null ? htmlspecialchars($edit[$plv]['Prenom']) : ''; ?>">

        <label for="Nom">edt.Nom:</label>
        <input type="text" required name="Nom" placeholder="Modifier le Nom" value="<?php echo $nr !== null ? htmlspecialchars($edit[$nlv]['Nom_Classe']) : ''; ?>">
        
        <label for="Id"> classes : </label>
        <select name="Id" required id="Id">
            <option value="">choisissez la classe</option value="<?php echo $nr !== null ? htmlspecialchars($edit[$clv]['Nom_Classe']) : ''; ?>">
            <?php        
                for ($i=0; $i <count($tbclas) ; $i++) 
                { 
                    echo '<option value="'.$tbclas[$i]['Id'].'">'.$tbclas[$i]['Nom_Classe'].'</option>';
                }; 
            ?>          
        </select>

        <button type="submit" name="ajouter">Ajouter</button>
        </form>
<h2>Classe sélectionnée :</h2>
<table border="1">
<tr><th>Id</th><th>Classes</th></tr>
<?php
if ($vr !== null) {
    echo '<tr>';
    echo '<td>'.htmlspecialchars($edit[$vr]['Id']).'</td>';
    echo '<td>'.htmlspecialchars($edit[$vr]['Nom_Classe']).'</td>';
    echo '</tr>';
}
?>
</table>
</body>
</html>
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