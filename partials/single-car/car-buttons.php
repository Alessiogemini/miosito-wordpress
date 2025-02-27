<?php
	$show_trade_in    = apply_filters( 'stm_me_get_nuxy_mod', false, 'show_trade_in' );
	$show_offer_price = apply_filters( 'stm_me_get_nuxy_mod', false, 'show_offer_price' );

if ( $show_offer_price || $show_trade_in ) : ?>

		<div class="stm-car_dealer-buttons heading-font">

			<?php if ( $show_trade_in ) : ?>
				<a href="#trade-in" data-toggle="modal" data-target="#trade-in">
					<?php esc_html_e( 'Trade in form', 'motors' ); ?>
					<i class="stm-moto-icon-trade"></i>
				</a>
			<?php endif; ?>

			<?php if ( $show_offer_price ) : ?>
				<a href="#trade-offer" data-toggle="modal" data-target="#trade-offer">
					<?php esc_html_e( 'Make an offer price', 'motors' ); ?>
					<i class="stm-moto-icon-cash"></i>
				</a>
			<?php endif; ?>

		</div>

<?php endif; ?>
