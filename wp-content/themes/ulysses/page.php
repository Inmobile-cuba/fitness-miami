<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
get_header();

	/* Enable/Disable Options */
	$page_sidebar_option = get_post_meta(get_the_ID(), 'page_sidebar_option', true);
	$page_layout = get_post_meta(get_the_ID(), 'page_layout', true);

	$page_spacing = "";
	$page_spacing = get_post_meta(get_the_ID(), 'page_spacing', true);
	?>

	<div class="blog-section<?php if( $page_spacing != "disable" ) { echo ' page_spacing'; } ?>">

		<div class="<?php if( $page_layout != 'page_layout_boxed' && !empty( $page_layout ) ) : echo 'container-fluid shortcode-view'; else : echo 'container'; endif; ?>">

			<div class="row">

				<div class="<?php if( $page_sidebar_option == 'sidebar_disabled' ) : echo 'col-md-12'; else : echo 'col-md-9'; endif; ?>">

					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					// End the loop.
					endwhile;
					?>

				</div>

				<?php if( $page_sidebar_option != 'sidebar_disabled' ) : ?>

				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<?php get_sidebar(); ?>
					</div>
				</div>

				<?php endif; ?>

			</div>

		</div>

	</div>
	<?php
get_footer();