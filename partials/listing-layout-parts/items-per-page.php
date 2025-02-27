<?php
$listing_grid_choices = explode( ',', apply_filters( 'stm_me_get_nuxy_mod', '9,12,18,27', 'listing_grid_choices' ) );
$view_type            = sanitize_file_name( apply_filters( 'stm_listings_input', apply_filters( 'stm_me_get_nuxy_mod', 'list', 'listing_view_type' ), 'view_type' ) );
$listing_grid_choice  = ( ! empty( get_post_meta( stm_get_listing_archive_page_id(), ( 'grid' === $view_type ) ? 'ppp_on_grid' : 'ppp_on_list', true ) ) ) ? get_post_meta( stm_get_listing_archive_page_id(), ( 'grid' === $view_type ) ? 'ppp_on_grid' : 'ppp_on_list', true ) : get_option( 'posts_per_page' );

if ( ! empty( $_GET['posts_per_page'] ) ) {//phpcs:ignore
	$listing_grid_choice = intval( $_GET['posts_per_page'] );//phpcs:ignore
}

if ( ! in_array( $listing_grid_choice, $listing_grid_choices, true ) ) {
	$listing_grid_choices[] = intval( $listing_grid_choice );
}

if ( ! empty( $listing_grid_choices ) ) : ?>
	<?php if ( apply_filters( 'stm_is_motorcycle', false ) ) : ?>
		<span class="stm_label heading-font"><?php esc_html_e( 'Vehicles per page:', 'motors' ); ?></span>
	<?php endif; ?>
	<span class="first"><?php esc_html_e( 'Show', 'motors' ); ?></span>
	<?php if ( apply_filters( 'stm_is_motorcycle', false ) ) : ?>
		<div class="stm_motorcycle_pp">
	<?php endif; ?>
	<ul>
		<?php foreach ( $listing_grid_choices as $listing_grid_choice_single ) : ?>
			<?php
			if ( $listing_grid_choice_single === $listing_grid_choice ) {
				$active = 'active';
			} else {
				$active = '';
			}

			$link = add_query_arg( array( 'posts_per_page' => intval( $listing_grid_choice_single ) ) );//phpcs:ignore
			$link = preg_replace( '/\/page\/\d+/', '', remove_query_arg( array( 'paged', 'ajax_action' ), $link ) );
			?>

			<li class="<?php echo esc_attr( $active ); ?>">
				<span>
					<a href="<?php echo esc_url( $link ); ?>">
						<?php echo intval( $listing_grid_choice_single ); ?>
					</a>
				</span>
			</li>

		<?php endforeach; ?>
	</ul>
	<?php if ( apply_filters( 'stm_is_motorcycle', false ) ) : ?>
		</div>
	<?php endif; ?>
	<span class="last"><?php esc_html_e( 'items per page', 'motors' ); ?></span>
<?php endif; ?>
