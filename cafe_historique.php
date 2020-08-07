<?php
    /*
    Template Name: Cafe Historique
    */
?>
<?php get_header(); ?>

<div class="container">
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        get_template_part( 'content', get_post_format() );
        endwhile; endif;
    ?>

    <?php the_content(); ?>
</div>

<main id="cafe_cotisation" class="container">

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
    ?>

<form id="form_cotisation">
<fieldset>
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
                            echo '<td><input type="button" style="width: 100%; color: transparent;" value="'.$Annee_Mois['cotisation'].'"></td>';
                        } else {
                            echo '<td><input type="button" style="width: 100%; color: transparent;" value="2"></td>';
                        }
                        
                    }
                }

                echo '</span></th></tr>';

                } while ($Membre_Cotisation = $out_Membre_Cotisation-> fetch(PDO::FETCH_ASSOC));
            }
    ?>
                
    </table>
    </fieldset>
</form>


</main>

<?php get_footer(); ?>