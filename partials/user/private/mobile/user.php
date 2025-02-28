<div class="stm-user-mobile-info-wrapper">
	<?php if ( ! is_user_logged_in() ) : ?>
		<div class="stm-login-form-mobile-unregistered">
			<form method="post">

				<div class="form-group">
					<h4><?php esc_html_e( 'Login or E-mail', 'motors' ); ?></h4>
					<input type="text" name="stm_user_login" placeholder="<?php esc_attr_e( 'Enter login or E-mail', 'motors' ); ?>"/>
				</div>

				<div class="form-group">
					<h4><?php esc_html_e( 'Password', 'motors' ); ?></h4>
					<input type="password" name="stm_user_password"  placeholder="<?php esc_attr_e( 'Enter password', 'motors' ); ?>"/>
				</div>

				<div class="form-group form-checker">
					<label>
						<input type="checkbox" name="stm_remember_me" />
						<span><?php esc_html_e( 'Remember me', 'motors' ); ?></span>
					</label>
				</div>
				<?php
				if ( apply_filters( 'stm_is_rental', false ) ) :
					?>
					<input type="hidden" name="redirect_path" value="<?php echo esc_url( get_the_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>"/><?php endif; ?>
				<?php
				if ( class_exists( 'SitePress' ) ) :
					?>
					<input type="hidden" name="current_lang" value="<?php echo esc_attr( ICL_LANGUAGE_CODE ); ?>"/><?php endif; ?>
				<input type="submit" value="<?php esc_attr_e( 'Login', 'motors' ); ?>"/>
				<span class="stm-listing-loader"><i class="stm-icon-load1"></i></span>
				<a href="<?php echo esc_url( stm_get_author_link( 'register' ) ); ?>" class="stm_label"><?php esc_html_e( 'Sign Up', 'motors' ); ?></a>
				<div class="stm-validation-message"></div>
			</form>
		</div>
		<?php
	else :
		$user = wp_get_current_user();

		$roles = $user->roles;
		if ( ! apply_filters( 'stm_is_rental', true ) ) :
			if ( in_array( 'stm_dealer', $roles, true ) ) {
				get_template_part( 'partials/user/private/mobile/dealer', 'profile' );
			} else {
				get_template_part( 'partials/user/private/mobile/user', 'profile' );
			}
		else :
			?>
			<span class="stm-rent-user-email h4">
				<?php echo esc_html( $user->user_email ); ?>
			</span>
			<?php if ( stm_is_woocommerce_activated() ) : ?>
				<div class="stm-rent-user-menu">
					<ul class="h4">
					<?php
					$account_path = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
					foreach ( wc_get_account_menu_items() as $k => $val ) {
						if ( 'dashboard' === $k ) {
							echo "<li class='stm-rent-user-menu-item " . esc_attr( wc_get_account_menu_item_classes( $k ) ) . "'><a href='" . esc_url( $account_path ) . "'>" . wp_kses_post( $val ) . '</a></li>';
						} else {
							echo "<li class='stm-rent-user-menu-item " . esc_attr( wc_get_account_menu_item_classes( $k ) ) . "'><a href='" . esc_url( wc_get_endpoint_url( $k ) ) . "'>" . wp_kses_post( $val ) . '</a></li>';
						}
					}
					?>
					</ul>
				</div>
				<?php
			endif;
		endif;
	endif;
	?>
</div>
