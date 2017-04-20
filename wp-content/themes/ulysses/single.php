<?php
/**
* The Template for displaying all single posts
*
* @package WordPress
* @subpackage ulysses
* @since ulysses 1.0
*/
get_header(); ?>

	<div class="blog-section page_spacing">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );

						// Previous/next post navigation.
						ulysses_post_nav();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() )
						{
							comments_template();
						}
					endwhile;
					?>
				</div>
				<div class="col-md-3">
					<div class="sidebar wow bounceInRight">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- === END BLOG RIGHT SIDEBAR === -->
	<?php
get_footer();