<footer class="footer inverse-wrapper">

	<?php get_template_part( 'inc/content-footer', 'widgets' ); ?>
	
	<div class="sub-footer">
		<div class="container inner">
			<p class="text-center">
				<?php 
					echo wpautop(
						wp_kses_post( 
							str_replace( 
								array( '*copy*', '*current_year*' ), 
								array( '&copy;', date( 'Y' ) ), 
								get_option( 'copyright', '*copy* *current_year* Lydia. Shared By <a href="https://www.themes24x7.com/">Themes24x7</a>') 
							) 
						)
					); 
				?>
			</p>
		</div>
	</div>

</footer>
  
<div class="slide-portfolio-overlay"></div>

</main>

<a href="#0" class="slide-portfolio-item-content-close"><i class="budicon-cancel-1"></i></a>

<?php wp_footer(); ?>
</body>
</html>