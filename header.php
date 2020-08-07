<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <title>
        <?php 
            if(is_front_page() || is_home()){
                echo get_bloginfo('name');
            } else{
                echo wp_title('') . " | " .get_bloginfo('name');
            }
        ?>
    </title>
</head>


<body>

    <!-- NAVBAR-->
    <nav class="navbar navbar-expand-lg py-0 navbar-light bg-white shadow-lg fixed-top" style="height: 50px;" id="nav_01">
        <div class="container">
            <div width="auto" height="50" alt="" class="d-inline-block align-left mr-2">
                <?php if( has_custom_logo() ):  ?>

                <?php 
                    // Get Custom Logo URL
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    $custom_logo_url = $custom_logo_data[0];
                ?>

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home">
                    <img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
                </a>

                <?php else: ?>
                    <div class="site-name" style="height: 50px; font-size: xx-large;"><a style="text-decoration: none;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></div>
                <?php endif; ?>
            </div>
        
            <?php 
                wp_nav_menu(
                    array(
                        'theme_location' => 'top_menu',
                        'menu_id' => 'top-menu',
                        'container' => 'ul',
                        'menu_class' => 'nav navbar-nav',
                        'walker' => new Walker_Nav_Top_Menu(),
                    )
                );
            ?>
        </div>
    </nav>
    

    <header>
        <div style="background-image: url('<?php the_post_thumbnail_url(); ?>') !important">
        <!-- if (exist(the_post_thumbnail_url())) {the_post_thumbnail_url();} else {get_template_directory_uri() . "/medias/innova.jpg";} -->
        <!-- style="background-image: url('<?php the_post_thumbnail_url(); ?>') !important" -->
            <h1>
                <?php 
                    if(is_front_page() || is_home() || is_page()){
                        // echo get_bloginfo('name');
                        echo "";
                    } else{
                        echo wp_title('');
                    }
                ?>
            </h1>
        </div>

        <nav class="navbar navbar-expand-lg py-0 navbar-dark shadow-lg justify-content-center">
        
            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
        
            <div id="navbarSupportedContent" class="collapse navbar-collapse">

            <?php wp_nav_menu(
                    array(
                        'theme_location' => 'main_menu',
                        'menu_id' => 'main-menu',
                        'container' => 'ul',
                        'menu_class' => 'nav navbar-nav m-auto justify-content-center',
                        'walker' => new Walker_Nav_Top_Menu(),
                    )
                );
            ?>
            </div>
            </div>
        </nav>

    </header>