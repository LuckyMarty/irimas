<?php

    if (isset($_POST['supprimer']))
    {
        $ID_membre = $_POST['ID_membre'];
        $date = date('Y-m');

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

        $in = "DELETE FROM membres WHERE ID=$ID_membre; DELETE FROM cotisation WHERE ID_membre=$ID_membre;";
        $conn->exec($in);

        header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe?utilisateur=supprime");
    }
?>