<?php get_header(); ?>

<main>
    <div class="container">
    <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
        get_template_part( 'content', get_post_format() );
        endwhile; endif;
    ?>

    <?php the_content(); ?>
    </div>
</main>

<?php get_footer(); ?>