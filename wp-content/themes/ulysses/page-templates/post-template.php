<?php
/*
	Template Name: Blog Template
*/
get_header(); ?>

	<!-- === START BLOG RIGHT SIDEBAR === -->
	
	<?php
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
					query_posts('posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged'));
					
					if ( have_posts() ) :
						
						while ( have_posts() ) : the_post();
							get_template_part( 'content', get_post_format() );
						endwhile;
						
						ulysses_paging_nav();
					
					else :
					
					// If no content, include the "No posts found" template.
						get_template_part( 'content', 'none' );
					
					endif;
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
	<!-- === END BLOG RIGHT SIDEBAR === -->
<?php get_footer(); ?>