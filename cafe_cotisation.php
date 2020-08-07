<?php

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


    if (isset($_POST['enregistrer']))
    {
        for ($i=3; $i>=-7 ; $i--)
        {
            $annee = date('Y');
            $mois = date('m') - $i; 

            if ($mois == 0)
            {
                $annee = date('Y') - 1;
                $mois = 12;
            }

            if ($mois == -1)
            {
                $annee = date('Y') - 1;
                $mois = 11;
            }

            if ($mois == -2)
            {
                $annee = date('Y') - 1;
                $mois = 10;
            }

            if ($mois == 13)
            {
                $annee = date('Y') + 1;
                $mois = 1;
            }

            if ($mois == 14)
            {
                $annee = date('Y') + 1;
                $mois = 2;
            }

            if ($mois == 15)
            {
                $annee = date('Y') + 1;
                $mois = 3;
            }

            $In_Is_Date = "SELECT * FROM cotisation WHERE annee=$annee AND mois=$mois;";
            // echo $In_Is_Date;
            $Out_Is_Date = $conn->query($In_Is_Date);
            $Is_Date = $Out_Is_Date-> fetch(PDO::FETCH_ASSOC);

            if ($Is_Date)
            {
                // echo "YES";

                // ******************************************************
                // TABLE MEMBRE
                // ******************************************************
                $In_Membre = "SELECT * FROM membres;";
                $Out_Membre = $conn->query($In_Membre);
                $Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC);

                do {
                    // ****************************************************** 
                    // TABLEAU MEMBRES
                    // ****************************************************** 
                    $In_Membre_ID = "SELECT ID FROM membres;";
                    $Out_Membre_ID = $conn->query($In_Membre_ID);
                    $Membre_ID = $Out_Membre_ID-> fetch(PDO::FETCH_ASSOC);

                    $Membre_ID = $Membre['ID'];

                    $In_Is_Member_In_Cotisation = "SELECT ID_membre, cotisation FROM cotisation WHERE annee=$annee AND mois=$mois AND ID_membre='$Membre_ID';";
                    $Out_Is_Member_In_Cotisation = $conn->query($In_Is_Member_In_Cotisation);
                    $Is_Member_In_Cotisation = $Out_Is_Member_In_Cotisation-> fetch(PDO::FETCH_ASSOC);

                    if ($Is_Member_In_Cotisation)
                    {
                        $In_Page_Member_ID = $_POST[$annee . $mois . $Membre_ID];

                        $In_MAJ_Membre = "UPDATE cotisation SET cotisation=$In_Page_Member_ID WHERE ID_membre='$Membre_ID' AND mois=$mois AND annee=$annee;";
                        // echo $In_MAJ_Membre;
                        $conn->exec($In_MAJ_Membre);
                    }
                } while($Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC)); 

            }
        }

        header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe/");
    }

    // ****************************************************** 
    // TABLEAU MEMBRES
    // ****************************************************** 
    $In_Membre = "SELECT ID FROM membres;";
    $Out_Membre = $conn->query($In_Membre);
    $Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['actualiser']))
    {
        for ($i=3; $i>=-7 ; $i--)
        {
            $annee = date('Y');
            $mois = date('m') - $i; 

            if ($mois == 0)
            {
                $annee = date('Y') - 1;
                $mois = 12;
            }

            if ($mois == -1)
            {
                $annee = date('Y') - 1;
                $mois = 11;
            }

            if ($mois == -2)
            {
                $annee = date('Y') - 1;
                $mois = 10;
            }

            if ($mois == 13)
            {
                $annee = date('Y') + 1;
                $mois = 1;
            }

            if ($mois == 14)
            {
                $annee = date('Y') + 1;
                $mois = 2;
            }

            if ($mois == 15)
            {
                $annee = date('Y') + 1;
                $mois = 3;
            }


            // ****************************************************** 
            // TABLEAU MEMBRES
            // ****************************************************** 
            $In_Membre_ID_Search = "SELECT ID FROM membres;";
            $Out_Membre_ID_Search = $conn->query($In_Membre_ID_Search);
            $Membre_ID_Search = $Out_Membre_ID_Search-> fetch(PDO::FETCH_ASSOC);

            $Membre_ID_Search = $Membre['ID'];

            do {
                $In_Is_Date = "SELECT * FROM cotisation WHERE annee=$annee AND mois=$mois AND ID_membre='$Membre_ID_Search';";
                // echo $In_Is_Date;
                $Out_Is_Date = $conn->query($In_Is_Date);
                $Is_Date = $Out_Is_Date-> fetch(PDO::FETCH_ASSOC);
    
                if ($Is_Date)
                {
                    // echo "YES";
    
                    do {
                        // ****************************************************** 
                        // TABLEAU MEMBRES
                        // ****************************************************** 
                        $In_Membre_ID = "SELECT ID FROM membres;";
                        $Out_Membre_ID = $conn->query($In_Membre_ID);
                        $Membre_ID = $Out_Membre_ID-> fetch(PDO::FETCH_ASSOC);
    
                        $Membre_ID = $Membre['ID'];
    
                        $In_Is_Member_In_Cotisation = "SELECT ID_membre FROM cotisation WHERE annee=$annee AND mois=$mois AND ID_membre='$Membre_ID';";
                        $Out_Is_Member_In_Cotisation = $conn->query($In_Is_Member_In_Cotisation);
                        $Is_Member_In_Cotisation = $Out_Is_Member_In_Cotisation-> fetch(PDO::FETCH_ASSOC);
    
                        if (!$Is_Member_In_Cotisation)
                        {
                            $In_Add_ID_Cotisation = "INSERT INTO cotisation (annee, mois, ID_membre, cotisation) VALUE ('$annee', '$mois', '$Membre_ID', '2');";
                            echo $In_Add_ID_Cotisation;
                            $conn->exec($In_Add_ID_Cotisation);
                            echo "YES";
                        }
                    } while($Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC)); 
    
                } else {
                    // echo "NO";
    
                    // ****************************************************** 
                    // TABLEAU MEMBRES
                    // ****************************************************** 
                    $In_Membre = "SELECT * FROM membres;";
                    $Out_Membre = $conn->query($In_Membre);
                    $Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC);
    
                    do {
                        $Membre_ID = $Membre['ID'];
    
                        $In_Add_ID_Cotisation = "INSERT INTO cotisation (annee, mois, ID_membre, cotisation) VALUE ('$annee', '$mois', '$Membre_ID', '2');";
                        $conn->exec($In_Add_ID_Cotisation);
                    } while($Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC));
                }
            } while($Membre = $Out_Membre-> fetch(PDO::FETCH_ASSOC));

        }

        header("Location: https://irimas.amelie-reinbold.fr/cotisation-cafe/");
    }
    
    ?>

            