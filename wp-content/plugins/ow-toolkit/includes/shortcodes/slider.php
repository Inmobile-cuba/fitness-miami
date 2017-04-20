<?php function ulysses_slider( $atts ){	global $ulysses_option;    extract(shortcode_atts(array(		'section_id' => ''    ), $atts));
	if( '' === $section_id ) :
		$section_id = __('slider','ulysses');
	endif;
	// START SLIDER SECTION 	ob_start();	?>	<!-- Home Slider Section -->	<section class="slider-section" id="<?php echo esc_attr( $section_id ); ?>">			<div class="home-slider-over">			<?php			$slider_args = array( 'post_type' => 'slider', 'posts_per_page' => -1 );			$slider_loop = new WP_Query( $slider_args );			if ( $slider_loop->have_posts() ) :				?>				<div id="home-slider" class="flexslider home-flexslider">					<ul class="slides">						<?php						while ( $slider_loop->have_posts() ) : $slider_loop->the_post();							$slide_bg = get_post_meta(get_the_ID(), 'slide_bg', true);							$slide_bg_image = wp_get_attachment_url( $slide_bg );							$slide_heading_1 = get_post_meta(get_the_ID(), 'slide_heading_1', true);							$slide_heading_1_effect = get_post_meta(get_the_ID(), 'slide_heading_1_effect', true);
							$slide_heading_2 = get_post_meta(get_the_ID(), 'slide_heading_2', true);							$slide_heading_2_effect = get_post_meta(get_the_ID(), 'slide_heading_2_effect', true);
							$slide_heading_3 = get_post_meta(get_the_ID(), 'slide_heading_3', true);							$slide_heading_3_effect = get_post_meta(get_the_ID(), 'slide_heading_3_effect', true);							?>							<li class="slider">								<div class="slide-text">									<h4 class="wow <?php echo esc_attr( $slide_heading_1_effect ); ?>" data-wow-delay="1s"><?php echo esc_attr( $slide_heading_1 ); ?></h4>									<h2 class="wow <?php echo esc_attr( $slide_heading_2_effect ); ?>" data-wow-delay="1s"><?php echo esc_attr( $slide_heading_2 ); ?></h2>									<h5 class="wow <?php echo esc_attr( $slide_heading_3_effect ); ?>" data-wow-delay="1s"><?php echo esc_attr( $slide_heading_3 ); ?></h5>								</div>								<img src="<?php echo esc_url( $slide_bg_image ); ?>" alt="<?php echo esc_attr( $slide_heading_1 ); ?>" />							</li><?php						endwhile;
						// Reset Post Data						wp_reset_postdata();						?>					</ul>				</div>				<?php			else:				?>				<div class="no-post-found path-section">					<div class="bg-cover">						<div class="container">							<h3><?php _e( 'No Slide Items Found', 'ulysses' ); ?></h3>						</div>					</div>				</div>				<?php			endif;			?>		</div>		<!-- Home Slider Over -->				</section>	<!-- Slider Section Over -->	<?php	return ob_get_clean();}add_shortcode('ulysses_slider', 'ulysses_slider');?>