<?php 
	if( '' === $section_id ) :
		$section_id = __('slider','ulysses');
	endif;
	// START SLIDER SECTION 
							$slide_heading_2 = get_post_meta(get_the_ID(), 'slide_heading_2', true);
							$slide_heading_3 = get_post_meta(get_the_ID(), 'slide_heading_3', true);
						// Reset Post Data