<?php
//about theme info
add_action( 'admin_menu', 'skt_minimal_abouttheme' );
function skt_minimal_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'skt-minimal'), esc_html__('About Theme', 'skt-minimal'), 'edit_theme_options', 'skt_minimal_guide', 'skt_minimal_mostrar_guide');   
} 
//guidline for about theme
function skt_minimal_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_html_e('Theme Information', 'skt-minimal'); ?>
		   </div>
          <p><?php esc_html_e('SKT Minimal is a minimalistic theme for neat white website design and clean user interface. Suitable for people who want to have a slate type website. Material and flat design UI for interior design, architecture, photography, creative, portfolio, software, consulting, furniture, digital and infographics type of site. Elementor based and comes packed with over 120+ other ready to use templates. Fast, easy and simple to use.','skt-minimal'); ?></p>
          <a href="<?php echo esc_url(SKT_MINIMAL_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(SKT_MINIMAL_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'skt-minimal'); ?></a> | 
				<a href="<?php echo esc_url(SKT_MINIMAL_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'skt-minimal'); ?></a> | 
				<a href="<?php echo esc_url(SKT_MINIMAL_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'skt-minimal'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_MINIMAL_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>