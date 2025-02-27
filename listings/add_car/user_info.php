<?php
$user = stm_get_user_custom_fields( $user_id );

if ( is_wp_error( $user ) ) {
	return;
}
$dealer = apply_filters( 'stm_get_user_role', false, $user['user_id'] );
if ( $dealer ) :
	$ratings = stm_get_dealer_marks( $user_id ); ?>

	<div class="stm-add-a-car-user">
		<div class="stm-add-a-car-user-wrapper">
			<div class="left-info left-dealer-info">
				<div class="stm-dealer-image-custom-view">
					<?php if ( ! empty( $user['logo'] ) ) : ?>
						<img src="<?php echo esc_url( $user['logo'] ); ?>"/>
					<?php else : ?>
						<img src="<?php stm_get_dealer_logo_placeholder(); ?>"/>
					<?php endif; ?>
				</div>
				<h4><?php stm_display_user_name( $user['user_id'], $user_login, $f_name, $l_name ); ?></h4>

				<?php if ( ! empty( $ratings['average'] ) ) : ?>
					<div class="stm-star-rating">
						<div class="inner">
							<div class="stm-star-rating-upper" style="width:<?php echo esc_attr( $ratings['average_width'] ); ?>"></div>
							<div class="stm-star-rating-lower"></div>
						</div>
						<div class="heading-font"><?php echo wp_kses_post( $ratings['average'] ); ?></div>
					</div>
				<?php endif; ?>

			</div>

			<ul class="add-car-btns-wrap">
				<?php
				if ( false === $restricted ) :
					$btnType = ( ! empty( $_id ) ) ? 'edit' : 'add';
					$btnType = ( ! empty( get_post_meta( $_id, 'pay_per_listing', true ) ) ) ? 'edit-ppl' : $btnType;
					?>
					<li class="btn-add-edit heading-font">
						<button type="submit" class="heading-font enabled" data-load="<?php echo esc_attr( $btnType ); ?>"
							<?php
							if ( empty( $_id ) ) {
								echo 'data-toggle="tooltip" data-placement="top" title="' . esc_html__( 'Add a Listing using Free or Paid Plan limits', 'motors' ) . '"';
							}
							?>
						>
							<?php if ( ! empty( $_id ) ) : ?>
								<i class="stm-service-icon-add_check"></i><?php esc_html_e( 'Edit Listing', 'motors' ); ?>
							<?php else : ?>
								<i class="stm-service-icon-add_check"></i><?php esc_html_e( 'Submit listing', 'motors' ); ?>
							<?php endif; ?>
						</button>
						<span class="stm-add-a-car-loader add"><i class="stm-icon-load1"></i></span>
					</li>
				<?php endif; ?>
				<?php if ( apply_filters( 'stm_me_get_nuxy_mod', false, 'dealer_pay_per_listing' ) && empty( $_id ) ) : ?>
					<li class="btn-ppl">
						<button type="submit" class="heading-font enabled" data-load="pay"
							<?php
							if ( empty( $_id ) ) {
								echo 'data-toggle="tooltip" data-placement="top" title="' . esc_html__( 'Pay for this Listing', 'motors' ) . '"';
							}
							?>
						>
							<i class="stm-service-icon-payment_listing"></i><?php esc_html_e( 'Pay for Listing', 'motors' ); ?>
						</button>
						<span class="stm-add-a-car-loader pay"><i class="stm-icon-load1"></i></span>
					</li>
				<?php endif; ?>
			</ul>

			<div class="right-info">

				<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'view-myself' => 1 ), get_author_posts_url( $user_id ) ) ); ?>">
					<i class="fas fa-external-link-alt"></i><?php esc_html_e( 'Show my Public Profile', 'motors' ); ?>
				</a>

				<div class="stm_logout">
					<a href="#"><?php esc_html_e( 'Log out', 'motors' ); ?></a>
					<?php esc_html_e( 'to choose a different account', 'motors' ); ?>
				</div>

			</div>

		</div>
	</div>

<?php else : ?>

	<div class="stm-add-a-car-user">
		<div class="stm-add-a-car-user-wrapper">
			<div class="left-info">
				<div class="avatar">
					<?php if ( ! empty( $user['image'] ) ) : ?>
						<img src="<?php echo esc_url( $user['image'] ); ?>"/>
					<?php else : ?>
						<i class="stm-service-icon-user"></i>
					<?php endif; ?>
				</div>
				<div class="user-info">
					<h4><?php stm_display_user_name( $user['user_id'], $user_login, $f_name, $l_name ); ?></h4>
					<div class="stm-label"><?php esc_html_e( 'Private Seller', 'motors' ); ?></div>
				</div>
			</div>

			<ul class="add-car-btns-wrap">
				<?php
				if ( false === $restricted ) :
					$btnType = ( ! empty( $_id ) ) ? 'edit' : 'add';
					$btnType = ( ! empty( get_post_meta( $_id, 'pay_per_listing', true ) ) ) ? 'edit-ppl' : $btnType;
					?>
					<li class="btn-add-edit heading-font">
						<button type="submit" class="heading-font enabled" data-load="<?php echo esc_attr( $btnType ); ?>"
							<?php
							if ( empty( $_id ) ) {
								echo 'data-toggle="tooltip" data-placement="top" title="' . esc_html__( 'Add a Listing using Free or Paid Plan limits', 'motors' ) . '"';
							}
							?>
						>
							<?php if ( ! empty( $_id ) ) : ?>
								<i class="stm-service-icon-add_check"></i><?php esc_html_e( 'Edit Listing', 'motors' ); ?>
							<?php else : ?>
								<i class="stm-service-icon-add_check"></i><?php esc_html_e( 'Submit listing', 'motors' ); ?>
							<?php endif; ?>
						</button>
						<span class="stm-add-a-car-loader add"><i class="stm-icon-load1"></i></span>
					</li>
				<?php endif; ?>
				<?php if ( apply_filters( 'stm_me_get_nuxy_mod', false, 'dealer_pay_per_listing' ) && empty( $_id ) ) : ?>
					<li class="btn-ppl">
						<button type="submit" class="heading-font enabled" data-load="pay"
							<?php
							if ( empty( $_id ) ) {
								echo 'data-toggle="tooltip" data-placement="top" title="' . esc_html__( 'Pay for this Listing', 'motors' ) . '"';
							}
							?>
						>
							<i class="stm-service-icon-payment_listing"></i><?php esc_html_e( 'Pay for Listing', 'motors' ); ?>
						</button>
						<span class="stm-add-a-car-loader pay"><i class="stm-icon-load1"></i></span>
					</li>
				<?php endif; ?>
			</ul>

			<div class="right-info">
				<a target="_blank" href="<?php echo esc_url( add_query_arg( array( 'view-myself' => 1 ), get_author_posts_url( $user_id ) ) ); ?>">
					<i class="fas fa-external-link-alt"></i><?php esc_html_e( 'Show my Public Profile', 'motors' ); ?>
				</a>
				<div class="stm_logout">
					<a href="#"><?php esc_html_e( 'Log out', 'motors' ); ?></a>
					<?php esc_html_e( 'to choose a different account', 'motors' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
endif;
