<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$item_id = $id ?? 0;

if ( ! empty( apply_filters( 'stm_listings_input', null, 'item_id' ) ) ) {
	$item_id = apply_filters( 'stm_listings_input', null, 'item_id' );
}

$max_file_size = apply_filters( 'stm_listing_media_upload_size', 1024 * 4000 ); /*4mb is the highest media upload here*/

$user_id = get_current_user_id();
$limits  = apply_filters(
	'stm_get_post_limits',
	array(
		'premoderation' => true,
		'posts_allowed' => 0,
		'posts'         => 0,
		'images'        => 0,
		'role'          => 'user',
	),
	$user_id
);
$crop    = apply_filters( 'stm_me_get_nuxy_mod', false, 'user_image_crop_checkbox' );
$width   = apply_filters( 'stm_me_get_nuxy_mod', 800, 'gallery_image_width' );
$height  = apply_filters( 'stm_me_get_nuxy_mod', 600, 'gallery_image_height' );

$_image_upload_script = "
    var stm_image_upload_settings = {
        messages: {
            ajax_error: '" . esc_html__( 'Some error occurred, try again later', 'motors' ) . "',
            wait_upload: '" . sprintf(
				/* translators: %s: uploading image dotted */
				esc_html__( 'Wait, uploading image%s', 'motors' ),
				'<strong class="stm-progress-bar__dotted"><span>.</span><span>.</span><span>.</span></strong>'
			) . "',
            format: '" . esc_html__( 'Sorry, you are trying to upload the wrong image format:', 'motors' ) . "',
            large: '" . esc_html__( 'Sorry, image is too large:', 'motors' ) . "',
            convert_heif: '" . esc_html__( 'Wait, converting image', 'motors' ) . "',
			rendering: '" . sprintf(
				/* translators: %s: rendering image dotted */
				esc_html__( 'Wait, rendering image%s', 'motors' ),
				'<strong class="stm-progress-bar__dotted"><span>.</span><span>.</span><span>.</span></strong>'
			) . "',
			optimizing_image: '" . sprintf(
				/* translators: %s: optimized image dotted */
				esc_html__( 'Wait, the image is being optimized%s', 'motors' ),
				'<strong class="stm-progress-bar__dotted"><span>.</span><span>.</span><span>.</span></strong>'
			) . "',
            limit: '" . sprintf(
				/* translators: %d: images limit */
				esc_html__( 'Sorry, you can upload only %d images per add', 'motors' ),
				$limits['images']
			) . "'
        },
        size: '" . $max_file_size . "',
        upload_limit: {
            max: '" . absint( $limits['images'] ) . "',
        },
        cropping: {
            enable: '" . $crop . "',
            width: '" . $width . "',
            height: '" . $height . "',
        }
    }
";

wp_add_inline_script( 'stm-theme-sell-a-car', $_image_upload_script, 'before' );
?>

<div class="stm-form-3-photos clearfix">
	<div class="stm-car-listing-data-single stm-border-top-unit">
		<div class="title heading-font"><?php esc_html_e( 'Upload photo', 'motors' ); ?></div>
		<span class="step_number step_number_3 heading-font"><?php esc_html_e( 'step', 'motors' ); ?> 3</span>
	</div>
	<div class="stm-media-car-add-nitofication">
		<?php
		if ( ! empty( $content ) ) {
			echo wpb_js_remove_wpautop( $content, true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>
	</div>
	<input
			type="file"
			id="stm_car_gallery_add"
			accept="image/*"
			name="stm_car_gallery_add"
			multiple>

	<!--Check if user not editing existing images-->
	<div class="stm-add-media-car">
		<div class="stm-media-car-gallery clearfix">
			<?php
			if ( empty( $item_id ) ) :
				do_action( 'stm_listings_load_template', 'add_car/image-gallery' );
			else :
				$_thumbnail_id = get_post_thumbnail_id( $item_id );
				$gallery       = get_post_meta( $item_id, 'gallery', true );

				if ( empty( $gallery ) || ! is_array( $gallery ) ) {
					$gallery = array();
				}

				if ( ! empty( $_thumbnail_id ) ) {
					array_unshift( $gallery, $_thumbnail_id );
				}

				$images_js = array();

				if ( ! empty( $gallery ) ) :
					$gallery   = array_values( array_unique( $gallery ) );
					$increment = 0;

					foreach ( $gallery as $gallery_key => $gallery_id ) :
						if ( ! wp_attachment_is_image( $gallery_id ) ) {
							continue;
						}

						$images_js[] = intval( $gallery_id );

						do_action(
							'stm_listings_load_template',
							'add_car/image-gallery',
							array(
								'attachment_id' => $gallery_id,
								'item_id'       => $increment,
							)
						);

						$increment ++;
					endforeach;
				endif;

				do_action( 'stm_listings_load_template', 'add_car/image-gallery' );
				?>

				<?php // phpcs:disable ?>
				<script type="text/javascript">
                    var stmUserFilesLoaded = [
						<?php echo implode( ',', $images_js ); ?>
                    ]
				</script>
				<?php // phpcs:enable ?>
			<?php endif; ?>
		</div>
	</div>
</div>
