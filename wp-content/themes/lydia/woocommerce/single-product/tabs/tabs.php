<?php
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="tabs tabs-top left tab-container ebor-<?php the_ID(); ?> boxed">
	
		<ul class="etabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="tab"><a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a></li> 
			<?php endforeach; ?>
		</ul>
		
		<div class="panel-container">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<div class="tab-block" id="tab-<?php echo esc_attr( $key ); ?>"><?php call_user_func( $tab['callback'], $key, $tab ); ?></div>
			<?php endforeach; ?>
		</div>
		
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function() {
			jQuery('.tabs.tabs-top.ebor-<?php the_ID(); ?>').easytabs({
			    animationSpeed: 300,
			    updateHash: false
			});
		});
	</script>

<?php endif; ?>
