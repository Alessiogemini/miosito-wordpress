<div class="stm-listing-layout-footer">
	<div class="container">
		<div class="clearfix">
			<div class="stm-footer-search-inventory">
				<?php
				$terms       = stm_get_footer_terms();
				$placeholder = '';
				if ( ! empty( $terms['names'] ) && ! empty( $terms['slugs'] ) ) : ?>

					<?php
					if ( ! empty( $_GET['stm-footer-search-name'] ) ) {
						$value = sanitize_text_field( $_GET['stm-footer-search-name'] );
					} else {
						$value = '';
					}

					$placeholder = '';

					if ( ! empty( $terms['placeholder'] ) ) {
						$placeholder = $terms['placeholder'];
					} else {
						$placeholder = esc_html__( 'Search Inventory', 'motors' );
					}
					?>

					<script>
						var stm_footer_terms = <?php echo wp_json_encode( $terms['names'] ); ?>;
						var stm_footer_terms_slugs = <?php echo wp_json_encode( $terms['slugs'] ); ?>;
						var stm_footer_taxes = <?php echo wp_json_encode( $terms['tax'] ); ?>;
						var stm_default_search_value = "<?php echo esc_js( $value ); ?>";
						jQuery(document).ready(function(){
							var $ = jQuery;
							$('.stm-footer-search-name-input').on('focus', function(){
								$(this).closest('.stm-footer-search-inventory').addClass('active');
							});

							$('.stm-footer-search-name-input').blur(function(){
								$(this).closest('.stm-footer-search-inventory').removeClass('active');
							});
						});
					</script>
				<?php endif; ?>

				<form method="get" action="<?php echo esc_url( apply_filters( 'stm_filter_listing_link', '' ) ); ?>">
					<input type="text" class="stm-footer-search-name-input" name="stm-footer-search-name" placeholder="<?php echo esc_attr( $placeholder ); ?>"/>
					<button type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>
			<div class="stm-footer-menu">
				<ul class="stm-listing-footer-menu clearfix">
					<?php
					wp_nav_menu(
						array(
							'menu'           => 'bottom_menu',
							'theme_location' => 'bottom_menu',
							'depth'          => 1,
							'container'      => false,
							'menu_class'     => 'stm-listing-footer-menu clearfix',
							'items_wrap'     => '%3$s',
							'fallback_cb'    => false,
						)
					);
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
