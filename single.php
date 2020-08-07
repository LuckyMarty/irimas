<?php
/*
 * The template for displaying all single posts
 */

get_header(); ?>
<a href=""></a>
<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/post/content', get_post_format() );

				echo "<div class='infos'>";
					echo "<div>Auteur : <a href='". get_author_posts_url(get_the_author_meta( 'ID' )) . "'>" . get_the_author() . "</a></div>";
					echo "<div>Date de publication : ". get_the_date() ."</div>";
				echo "</div>";
				
				the_content();

				$medias = get_attached_media( '', $post->ID );

				if ($medias)
				{
					$medias = get_attached_media( '', $post->ID );
					echo "Pièces Jointes :";
					echo "<ul style='padding-left: 40px;'>";
					foreach($medias as $media) 
					{ 
						echo "<li><a download href=" . wp_get_attachment_url($media->ID) . ">" . get_the_title($media->ID) . "." . wp_check_filetype(wp_get_attachment_url($media->ID))['ext'] ."</a></li>";
					}
					echo "</ul>";
				}

				edit_post_link();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

				the_post_navigation(
					array(
						'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'irimas' ) . '</span>  🠜  <span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'irimas' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper"></span>%title</span>',
						'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'irimas' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'irimas' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">  🠞  </span></span>',
					)
				);

			endwhile; // End the loop.
			?>

		</main>
	</div>
</div>

<?php
get_footer();
