<?php 
	$default = get_option( 'custom_logo_dark', EBOR_THEME_DIRECTORY . 'style/images/logo-dark.png' );
	$default_retina = get_option( 'custom_logo_dark_retina', EBOR_THEME_DIRECTORY . 'style/images/logo-dark@2x.png' );
	$default_light = get_option( 'custom_logo', EBOR_THEME_DIRECTORY . 'style/images/logo.png' );
	$default_light_retina = get_option( 'custom_logo_retina', EBOR_THEME_DIRECTORY . 'style/images/logo@2x.png' );
?>

<div class="navbar solid dark">

	<div class="navbar-header">
		<div class="basic-wrapper"> 
			
			<div class="navbar-brand"> 
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img 
						src="#" 
						srcset="<?php echo esc_url( $default_light ); ?> 1x, <?php echo esc_url( $default_light_retina ); ?> 2x" 
						class="logo-light" 
						alt="<?php bloginfo( 'title' ); ?>" 
					/>
					<img 
						src="#" 
						srcset="<?php echo esc_url( $default ); ?> 1x, <?php echo esc_url( $default_retina ); ?> 2x" 
						class="logo-dark" 
						alt="<?php bloginfo( 'title' ); ?>" 
					/>
				</a>
			</div>
			
			<a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
		
		</div>
	</div>
	
	<nav class="collapse navbar-collapse">
		<?php
			if ( has_nav_menu( 'primary' ) ){
				wp_nav_menu( 
					array(
					    'theme_location'    => 'primary',
					    'depth'             => 3,
					    'container'         => false,
					    'container_class'   => false,
					    'menu_class'        => 'nav navbar-nav',
					    'menu_id'           => 'menu-standard-navigation',
					    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
					    'walker'            => new ebor_bootstrap_navwalker()
					)
				);
			}
		?> 
	</nav>
	
	<div class="social-wrapper">
		<ul class="social naked">
			<?php
				if( function_exists( 'ebor_cart_icon' ) ){
					echo ebor_cart_icon();
				}
				
				$protocols = array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet', 'skype' );
				
				for( $i = 1; $i < 7; $i++ ){
					if( get_option("header_social_url_$i") ) {
						echo '<li>
							      <a href="' . esc_url( get_option( "header_social_url_$i" ), $protocols ) . '" target="_blank">
								      <i class="icon-s-' . get_option( "header_social_icon_$i" ) . '"></i>
							      </a>
							  </li>';
					}
				} 
			?>
		</ul>
	</div>

</div>

<div class="offset"></div>