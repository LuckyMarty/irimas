<?php

    if (isset($_POST['ajouter']))
    {
        // echo 'Good';
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mail = $_POST['mail'];

        // Connect to Database
        require('cafe_config_cotisation_cafe.php');

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // set the PDO error mode to exception
        }
        catch (PDOException $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    } else echo 'Try again';
    

    // ****************************************************** 
    // TABLEAU MEMBRES
    // ****************************************************** 
    $inMembre = "SELECT ID, Nom, Prénom FROM membres;";
    $outMembre = $conn->query($inMembre);
    $Membre = $outMembre-> fetch(PDO::FETCH_ASSOC);


    // ****************************************************** 
    // Vérifier si l'utilisateur est déjà enregistré
    // ******************************************************
    if (!empty($_POST['nom']) || !empty($_POST['prenom'])) 
    {
        while ($Membre = $outMembre-> fetch(PDO::FETCH_ASSOC))
        {
            if (strtolower($prenom) == strtolower($Membre['Prénom']) || strtolower($nom) == strtolower($Membre['Nom']))
            {
                return header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe?utilisateur=existe");
            }
        }


    // ****************************************************** 
    // AJOUTER UN UTILISATEUR
    // ****************************************************** 
        $in = "INSERT INTO membres (Nom, Prénom, Mail) VALUE ('$nom', '$prenom', '$mail');";
        $conn->exec($in);

        header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe?utilisateur=ajoute");
        
    } else 
    {
        header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe/");
    }
?>