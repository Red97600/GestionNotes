-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 nov. 2025 à 05:12
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionnotes`
--

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `Id` int(11) NOT NULL,
  `Nom_Classe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`Id`, `Nom_Classe`) VALUES
(1, '[SIO2]');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Id_Classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`Id`, `Nom`, `Prenom`, `Id_Classe`) VALUES
(1, '[SAINDOU]', '[Djanfar]', 0),
(2, '[FAYADHUI]', '[Nassur]', 0),
(3, '[ABDALLAH]', '[Oumair]', 0),
(4, '[AHMED]', '[Said]', 0),
(5, '[MAHAVITENY]', '[Azaly]', 0);

-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

CREATE TABLE `matieres` (
  `Id` int(11) NOT NULL,
  `Nom_Matieres` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matieres`
--

INSERT INTO `matieres` (`Id`, `Nom_Matieres`) VALUES
(1, '[CEJM]'),
(2, '[CYBERSECURITE]'),
(3, '[FRANCAIS]'),
(4, '[ANGLAIS]');

-- --------------------------------------------------------

--
-- Structure de la table `notes`
--

CREATE TABLE `notes` (
  `Id` int(11) NOT NULL,
  `Note` float NOT NULL,
  `Date` date NOT NULL,
  `Id_Eleve` int(11) NOT NULL,
  `Id_Matieres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notes`
--

INSERT INTO `notes` (`Id`, `Note`, `Date`, `Id_Eleve`, `Id_Matieres`) VALUES
(1, 0, '0000-00-00', 0, 0),
(2, 5, '0000-00-00', 0, 0),
(3, 0, '0000-00-00', 0, 0),
(4, 0, '0000-00-00', 0, 0),
(5, 0, '0000-00-00', 0, 0),
(6, 0, '0000-00-00', 0, 0),
(7, 0, '0000-00-00', 0, 0),
(8, 0, '0000-00-00', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `matieres`
--
ALTER TABLE `matieres`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `notes`
--
ALTER TABLE `notes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




















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

        <ul>
            <form method="get" action="note.php">
                <label for="Id">Veillez selectionnez l'élève que vous souhaitez voir ses notes :</label>
               <select name="Id" Id="Id">

                    <?php
                        for ($i=0; $i <count($eleves1) ; $i++) 
                        { 
                            echo '<option value="'.$i.'">'.$eleves1[$i].'</option>';
                        }; 
                    ?>
               </select>
               <button type="submit">afficher</button>
            </form>
            
        </ul>

        <?php
        echo "<table border='1'>";
        echo "<tr>
               <th>Nom</th>
               <th>Prenom</th>
               <th>Classe</th>
               <th>Matiere</th>
               <th>Note</th>
               <th>Date</th>
               </tr>";

         for ($i=0; $i <count($etudiants) ; $i++)  
           {    if(isset($_GET['Id']))
                {
                    if ($etudiants[$i]['Id']== $_GET['Id'] )
                    {
                        echo "<tr>";
                            echo "<td>".$etudiants[$i]['nom']."</td>";
                            echo "<td>".$etudiants[$i]['prenom']."</td>";
                            echo "<td>".$etudiants[$i]['classe']."</td>";
                            echo "<td>".$etudiants[$i]['matiere']."</td>";
                            echo "<td>".$etudiants[$i]['note']."</td>";
                            echo "<td>".$etudiants[$i]['date']."</td>";
                        echo "</tr>";
                    }
                }
            }
         echo "<table>";
       
       ?>
    </body>
</html>