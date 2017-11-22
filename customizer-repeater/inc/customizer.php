<?php
/**
 * Functions needed for repeater.
 *
 * @package customizer-controls
 */

/**
 * Register customizer repeater.
 */
function customizer_repeater_register() {
	require_once( get_template_directory() . '/customizer-repeater/class/class-customizer-repeater.php' );
}
add_action( 'customize_register', 'customizer_repeater_register' );

/**
 * Sanitization function.
 *
 * @param string $input Control input.
 *
 * @return string
 */
function customizer_repeater_sanitize( $input ) {
	$input_decoded = json_decode( $input, true );
	if ( ! empty( $input_decoded ) ) {
		foreach ( $input_decoded as $boxk => $box ) {
			foreach ( $box as $key => $value ) {

					$input_decoded[ $boxk ][ $key ] = wp_kses_post( force_balance_tags( $value ) );

			}
		}
		return json_encode( $input_decoded );
	}
	return $input;
}
