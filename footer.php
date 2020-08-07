<footer class="container-fluid text-center">
          <?php wp_nav_menu(
                    array(
                        'theme_location' => 'footer_menu',
                        'menu_id' => 'footer-menu',
                        'container' => 'ul',
                        'menu_class' => 'nav justify-content-centerr',
                        'walker' => new Walker_Nav_Top_Menu(),
                    )
                );
            ?>

          <span><span id="copyright_year"></span> &copy; <a class="text-white" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo('name'); ?></a> | <a href="#" class="text-white">Mentions Légales</a></span>
    </footer>
    

    <?php wp_footer(); ?>
    
</body>
</html>