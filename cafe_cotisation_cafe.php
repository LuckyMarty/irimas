<?php get_header(); ?>

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


// MEMBRES
    $inMembre = "SELECT ID, Nom, Prénom FROM membres;";
    $outMembre = $conn->query($inMembre);
    $Membre = $outMembre-> fetch(PDO::FETCH_ASSOC);
?>


<div class="container">
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        get_template_part( 'content', get_post_format() );
        endwhile; endif;
    ?>

    <?php the_content(); ?>
</div>


<main id="cafe_cotisation" class="container">
    <form id="form_ajouter" action="<?php echo get_template_directory_uri(); ?>/cafe_ajouter.php" method="post">
        <fieldset>
            <legend>Ajouter un membre</legend>
            <div class='ligne1'>
                <span>Nom</span>        <input name="nom"       type="text"     required>
                <span>Prénom</span>     <input name="prenom"    type="text"     required>
            </div>
            
            <div class='ligne2'>
                <span>Mail</span>       <input name="mail"      type="email"    required>
            </div>
            <?php 
                if (isset($_GET['utilisateur'])) {$utilisateur = $_GET['utilisateur'];} else $utilisateur = "";

                switch ($utilisateur) {
                    case 'existe':
                        echo "<div><b>Cet utilisateur existe déjà</b></div>";
                        break;
                    case 'ajoute':
                        echo "<div><b>Cet utilisateur vient d'être ajouté</b></div>";
                    break;
                }
            ?>
            
            <div class='ligne3'>
                <input name="ajouter" type="submit" value="Ajouter">
            </div>

        </fieldset>
    </form>

    <form id="form_supprimer" action="<?php echo get_template_directory_uri(); ?>/cafe_supprimer.php" method="post">
        <fieldset>
            <legend>Supprimer un membre</legend>

            <select name="ID_membre" id="">
                <option value="">Selectionner un utilisateur</option>
                <?php
                    do {
                        echo '<option value="'.$Membre['ID'].'">'.$Membre['Nom'].' '.$Membre['Prénom'].'</option>';
                    }while ($Membre = $outMembre-> fetch(PDO::FETCH_ASSOC));
                ?>
            </select>

            <input name="supprimer" type="submit" value="Supprimer">
            <?php 
                if ($utilisateur == "supprime")
                {
                    echo "<div><b>L'utilisateur a bien été supprimé</b></div>";
                } else echo " ";
            ?>
        </fieldset>
    </form>

    <form id="form_cotisation" action="<?php echo get_template_directory_uri(); ?>/cafe_cotisation.php" method="post">
        <fieldset>
            <legend><?php
                    // $date1 = date('Y-m-d');
                    // setlocale(LC_TIME, "fr_FR");
                    // echo strftime("%B %G", strtotime($date1));
                    echo "Calendrier - Cotisation";
            ?></legend>

            <input type="hidden" name="id_annee_cotisation" value="<?php echo date('Y'); ?>">
            <input type="hidden" name="id_mois_cotisation" value="<?php echo date('m'); ?>">

            <table>
            <tr>
                <th> </th>

                <?php

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


                        $in_Annee_Mois = "SELECT annee, mois FROM cotisation WHERE annee=$annee AND mois=$mois;";
                        $out_Annee_Mois = $conn->query($in_Annee_Mois);
                        $Annee_Mois = $out_Annee_Mois-> fetch(PDO::FETCH_ASSOC);
                        
                        if ($Annee_Mois)
                        {
                            echo '<th><span>'.$Annee_Mois['annee'].'-'.  $Annee_Mois["mois"].'</span></th>';
                        }
                    }
                ?>
            </tr>

            <?php

                    $in_Membre_Cotisation= "SELECT * FROM membres;";
                    $out_Membre_Cotisation = $conn->query($in_Membre_Cotisation);
                    $Membre_Cotisation = $out_Membre_Cotisation-> fetch(PDO::FETCH_ASSOC);
                    
                    if ($Membre_Cotisation)
                    {
                        do {

                        echo '<tr><th><span>'. $Membre_Cotisation['Nom']. ' ' . $Membre_Cotisation['Prénom'];
                        
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

                            $ID_membre = $Membre_Cotisation['ID'];
                            $in_Annee_Mois = "SELECT * FROM cotisation WHERE annee=$annee AND mois=$mois AND ID_membre=$ID_membre;";
                            $out_Annee_Mois = $conn->query($in_Annee_Mois);
                            $Annee_Mois = $out_Annee_Mois-> fetch(PDO::FETCH_ASSOC);
                            
                            if ($Annee_Mois)
                            {
                                if ($Annee_Mois['annee'] && $Annee_Mois['mois'])
                                {
                                    echo '<td><input type="hidden" name="'.$Annee_Mois['annee'].$Annee_Mois['mois'].$Annee_Mois['ID_membre'].'" value="'.$Annee_Mois['cotisation'].'"><input onclick="cotisation(this)" type="button" style="width: 100%; color: transparent;" value="'.$Annee_Mois['cotisation'].'"></td>';
                                } else {
                                    echo '<td><input type="hidden" name="" value="2"><input onclick="cotisation(this)" type="button" style="width: 100%; color: transparent;" value="2"></td>';
                                }
                               
                            }
                        }

                        echo '</span></th></tr>';

                        } while ($Membre_Cotisation = $out_Membre_Cotisation-> fetch(PDO::FETCH_ASSOC));
                    }
            ?>
                       
            </table>

            <input name="enregistrer" type="submit" value="Enregistrer">
            <input type="submit" value="Actualiser" name="actualiser">
       
        </fieldset>
    </form>

</main>
    
<?php get_footer(); ?>