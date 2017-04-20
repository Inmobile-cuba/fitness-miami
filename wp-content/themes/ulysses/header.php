<?php
/**
 * The Header for our theme
 *
 *
 * @package WordPress
 * @subpackage ulysses
 * @since ulysses 1.0
 */
global $ulysses_option;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo esc_url($ulysses_option['opt_favicon_logo']['url']); ?>" type="image/x-icon" />

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head();?>
</head>
<body <?php body_class(); ?> data-offset="200" data-spy="scroll" data-target=".navbar-custom">
	<a id="goto-top"></a>
	<?php
	global $woocommerce;
	$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );	
	?>
	<div class="load-complete">
		<div class="load-position">
			<div class="logo"><img src="<?php echo esc_url( $ulysses_option['opt_site_logo']['url'] ); ?>" alt="<?php echo esc_html( get_bloginfo('name') ); ?>"/></div>
			<h6><?php _e( 'Please wait, loading...', 'ulysses' ) ?></h6>
			<div class="loading">
				<div class="loading-line"></div>
				<div class="loading-break loading-dot-1"></div>
				<div class="loading-break loading-dot-2"></div>
				<div class="loading-break loading-dot-3"></div>
			</div>
		</div>
	</div>
	<div class="box-wide">
		<!-- === START HEADER === -->
		<header class="header sticky-wrapper sticky-bar">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-xs-3">
						<div class="logo"><a class="to-top" href="<?php if(is_home() || is_front_page()): echo '#goto-top'; else : echo esc_url( home_url( '/' ) ); endif; ?>"><img src="<?php echo esc_url( $ulysses_option['opt_site_logo']['url'] ); ?>" alt="<?php echo esc_html( get_bloginfo('name') ); ?>"/></a></div>
					</div>
					<div class="col-md-10 col-xs-9">

						<ul class="user-menu">

							<li class="user-acc">

								<a href="<?php echo esc_url(get_permalink( $myaccount_page_id )); ?>"><i class="user-icon"></i></a>

								<ul class="dropdown-menu">

									<?php
									if ( is_user_logged_in() ) { ?>
										<li><a class="d-text-c-h" href="<?php if ( $myaccount_page_id ) { echo esc_url(get_permalink( $myaccount_page_id )); } ?>" title="<?php _e('My Account','ulysses'); ?>"><?php _e('My Account','ulysses'); ?></a></li>
										<li><a class="d-text-c-h" href="<?php echo wp_logout_url( esc_url( get_permalink() ) ); ?>" title="Logout"><?php _e('Logout','ulysses'); ?></a></li>
										<?php
									}
									else {
										?>
										<li>

											<?php
											if( get_page_by_title( 'User Account' ) ) { ?>
												<a class="d-text-c-h" href="<?php echo esc_url( get_permalink( get_page_by_title( 'User Account' ) ) ); ?>"><?php _e('Login','ulysses'); ?></a>
												<?php
											}
											else {
												?>
												<a class="d-text-c-h" href="#"><?php _e('Login','ulysses'); ?></a>
												<?php
											}
											?>

										</li>
										<?php
									}
									?>

								</ul>

							</li>

							<li class="cart-ddl">
								<?php
								if( class_exists('woocommerce') ) {

									if( get_page_by_title( 'Cart' ) ) { ?>
										<a class="d-text-c-h" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Cart' ) ) ); ?>">
											<i class="cart-icon"></i>
										</a>
										<?php
									}
									else {
										?>
										<a class="d-text-c-h" href="#"><i class="cart-icon"></i></a>
										<?php
									}
									?>
									<ul class="dropdown-menu cart-dropdown">
										<li>									
											<span class="cart_details"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count); ?><?php _e( ', Total of ', 'ulysses' ) ?><?php echo $woocommerce->cart->get_cart_total(); ?></span>
											<a class="checkout" title="View your shopping cart" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Cart' ) ) ); ?>">
												<?php _e( 'Checkout ', 'ulysses' ) ?><span class="icon-chevron-right"></span>
											</a>
										</li>
									</ul>
									<?php
								}
								?>
							</li>

							<li class="menu-toggle">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
									<i class="fa fa-bars"></i>
								</button>
							</li>

						</ul>

						<nav id="navbar" class="nav menu navbar navbar-custom navbar-fixed-top" role="navigation">

							<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
								<?php
								$nav = "";
								$nav = get_post_meta( get_the_ID(), 'page_navmenu', true );

								if( $nav != "" && $nav != "0" ) {

									wp_nav_menu( array(
										'menu' => $nav,
										'theme_location' => 'primary',
										'container' => false,
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'menu_class' => 'nav navbar-nav',
										'depth' => 10 ,
										'walker' => new ow_wp_nav_walker
									));
								}
								elseif( has_nav_menu('primary') ) {

									wp_nav_menu( array(
										'theme_location' => 'primary',
										'container' => false,
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth' => 10,
										'menu_class' => 'nav navbar-nav',
										'walker' => new ow_wp_nav_walker
									));
								}
								else {
									echo '<ul class="nav navbar-nav">'
									.wp_list_pages( array(
										'echo'            => 0,
										'walker'          => new ow_wp_page_walker,
										'title_li'        => ''
									)).'</ul>';
								}
								?>
							</div>

						</nav>

					</div>

				</div>

			</div>

		</header>

		<div class="content">

			<?php
			$page_title_option = "";
			$page_title_option = get_post_meta( ulysses_get_the_ID(), 'page_title_option', true );

			$page_banner = "";
			$page_banner = get_post_meta( ulysses_get_the_ID(), 'page_banner_option', true );

			if( $page_banner != "" ) {
				$header_image = " style='background-image: url(".esc_url( wp_get_attachment_url( $page_banner ) ).");'";
			}
			else {
				$header_image = " style='background-image: url(".esc_url( get_template_directory_uri() . '/images/slide-1.jpg' ).");'";
			}

			if( $page_title_option != 'page_title_disabled' ) {
				?>
				<div class="path-section"<?php if( !empty( $header_image ) ) { echo html_entity_decode( $header_image ); } ?>>
					<div class="bg-cover">
						<div class="container">
							<h3>
								<?php
								if( is_home() ) {
									esc_html_e( 'Blog', "ulysses" );
								}
								if( is_404() ) {
									esc_html_e( 'Error Page', "ulysses" );
								}
								elseif( is_search() ) {
									printf( esc_html__( 'Search Results for: %s', "ulysses" ), get_search_query() );
								}
								elseif( is_archive() ) {

									the_archive_title();
								}
								elseif( ! is_home() ) {
									the_title();
								}
								elseif( is_single() ) {
									the_title();
								}
								?>
							</h3>
						</div>
					</div>
				</div>
				<?php
			} ?>