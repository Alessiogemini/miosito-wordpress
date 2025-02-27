<?php $total_matches = $filter['total']; ?>

<div class="stm-car-listing-sort-units stm-car-listing-directory-sort-units clearfix">
	<?php if ( ! apply_filters( 'stm_is_car_dealer', true ) ) : ?>
		<div class="stm-listing-directory-title">
			<h3 class="title"><?php echo ( isset( $filter['listing_title'] ) ) ? esc_attr( $filter['listing_title'] ) : ''; ?></h3>
		</div>
	<?php endif; ?>
	<div class="stm-directory-listing-top__right">
		<div class="clearfix">
			<?php
			$nuxy_mod_option = apply_filters( 'stm_me_get_nuxy_mod', 'list', 'listing_view_type' );

			if ( wp_is_mobile() ) {
				$nuxy_mod_option = apply_filters( 'stm_me_get_nuxy_mod', 'grid', 'listing_view_type_mobile' );
			}
			$view_type       = apply_filters( 'stm_listings_input', $nuxy_mod_option, 'view_type' );

			$view_list = ( 'list' === $view_type ) ? 'active' : '';
			$view_grid = ( 'list' !== $view_type ) ? 'active' : '';

			?>
			<div class="stm-view-by">
				<a href="#" class="view-grid view-type <?php echo esc_attr( $view_grid ); ?>" data-view="grid">
					<i class="stm-icon-grid"></i>
				</a>
				<a href="#" class="view-list view-type <?php echo esc_attr( $view_list ); ?>" data-view="list">
					<i class="stm-icon-list"></i>
				</a>
			</div>
			<div class="stm-sort-by-options clearfix">
				<span><?php esc_html_e( 'Sort by:', 'motors' ); ?></span>
				<div class="stm-select-sorting">
					<select>
						<?php echo wp_kses_post( apply_filters( 'stm_get_sort_options_html', '' ) ); ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
