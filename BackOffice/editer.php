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

if (isset($_POST['Editer']) && isset($_POST['Id']) && !empty($_POST['Id']) && isset($_POST['Nom_Classe']) && !empty($_POST['Nom_Classe'])) {
    $idClasse = (int)$_POST['Id'];
    $nouveauNom = trim($_POST['Nom_Classe']);
    $update = $mysqlClient->prepare('UPDATE classes SET Nom_Classe = :Nom_Classe WHERE Id = :Id');
    $update->execute(['Nom_Classe' => $nouveauNom, 'Id' => $idClasse]);
    header("Location: classes.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Édition Classe</title>
</head>
<body>
<h1>Éditer une classe</h1>
<form action="" method="POST">
<label for="Nom_Classe">Modifier :</label>
<input type="text" name="Nom_Classe" placeholder="Modifier la classe" value="<?php echo $vr !== null ? htmlspecialchars($edit[$vr]['Nom_Classe']) : ''; ?>">
<button type="submit" name="Editer">Editer</button>
<?php if ($Id !== null): ?><input type="hidden" name="Id" value="<?php echo $Id; ?>"><?php endif; ?>
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
