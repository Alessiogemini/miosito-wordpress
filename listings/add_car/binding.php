<?php //phpcs:disable ?>
<script type="text/javascript">
	jQuery(function ($) {
		let options = <?php echo wp_json_encode( apply_filters( 'stm_data_binding_func', array(), true, true ) ); ?>,
			options_2 = options;

		$.each(options, function (slug, config) {
			config.selector = '[name="stm_f_s[' + slug.replace('-',  '_pre_') + ']"]';
		});

		$('.stm_add_car_form .stm_add_car_form_1 .stm-form1-intro-unit').each(function () {
			new STMCascadingSelect(this, options);
		});

		$.each(options_2, function (slug, config) {
			config.selector = '[name="stm_s_s_' + slug.replace('-',  '_pre_') + '"]';
		});

		$('.stm_add_car_form .stm_add_car_form_1 .stm-form-1-end-unit').each(function () {
			new STMCascadingSelect(this, options_2);
		});
	});
</script>
<?php //phpcs:enable ?>

