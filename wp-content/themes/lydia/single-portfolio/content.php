<div class="container inner2">
	<?php 
		the_title( '<h2 class="post-title">', '</h2>' );
		get_template_part( 'single-portfolio/content', 'meta' );
		the_content();
	?>
</div>