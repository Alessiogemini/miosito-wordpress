<?php $current_view_type = apply_filters( 'stm_listings_input', apply_filters( 'stm_me_get_nuxy_mod', 'list', 'listing_view_type' ), 'view_type' ); ?>

<div class="stm-car-listing-sort-units clearfix sort-type-<?php echo esc_attr( $current_view_type ); ?>">
	<?php if ( 'grid' === $current_view_type ) : ?>
		<div class="stm-sort-by-options clearfix">
			<span><?php esc_html_e( 'Sort by:', 'motors' ); ?></span>
			<div class="stm-select-sorting">
				<select>
					<?php echo wp_kses_post( apply_filters( 'stm_get_sort_options_html', '' ) ); ?>
				</select>
			</div>
		</div>
		<div class="stm_boats_view_by">
			<?php get_template_part( 'partials/listing-layout-parts/items-per', 'page' ); ?>
		</div>
	<?php else : ?>
		<?php get_template_part( 'partials/listing-layout-parts/boats-list', 'sort' ); ?>
	<?php endif; ?>
</div>
