<?php
$top_bar_login = apply_filters( 'stm_me_get_nuxy_mod', false, 'top_bar_login' );

$link = stm_get_author_link( 'register' );

?>

<?php if ( $top_bar_login ) : ?>
	<ul class="login-reg-urls">
		<li><i class="stm-all-icon-lnr-user"></i></li>
		<li class="login-reg-urls-sing-in"><a href="<?php echo esc_url( $link ); ?>"><?php esc_html_e( 'Login', 'motors' ); ?></a></li>
		<li class="login-reg-urls-sing-up"><a href="<?php echo esc_url( $link ); ?>"><?php esc_html_e( 'Register', 'motors' ); ?></a>
		</li>
	</ul>
<?php endif; ?>
