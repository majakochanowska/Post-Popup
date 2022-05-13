<?php
/**
 * Post Popup
 *
 * @package post-popup
 */

namespace Maja\PostPopup\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use const \Maja\PostPopup\MAIN_FILE;
use const \Maja\PostPopup\VERSION;
use \Maja\PostPopup\Interfaces\Module;

/**
 * Class definition
 */
class Popup implements Module {

	/**
	 * Register WordPress hooks
	 */
	public static function register() {

		add_action( 'init', array( get_class(), 'register_popup_post_type' ) );
		add_action( 'wp_head', array( get_class(), 'create_popup' ) );
		add_action( 'wp_enqueue_scripts', array( get_class(), 'enqueue_scripts' ) );
	}

	/**
	 * Register "Popup" custom post type
	 */
	public static function register_popup_post_type() {

		register_post_type(
			'post-popup',
			array(
				'labels'       => array(
					'name' => __( 'Popup', 'post-popup' ),
				),
				'public'       => true,
				'show_in_rest' => true,
			)
		);
	}

	/**
	 * Get post to display in popup
	 */
	public static function get_post_for_popup() {

		$posts = get_posts(
			array(
				'post_type'   => 'post-popup',
				'post_status' => 'publish',
				'numberposts' => -1,
				'order'       => 'ASC',
			)
		);

		foreach ( $posts as $post ) {
			$display_in_popup = get_field( 'display_in_popup', $post->ID );

			if ( true === $display_in_popup ) {
				$post_for_popup = $post;
			}
		}

		if ( ! isset( $post_for_popup ) ) {
			return;
		}

		return $post_for_popup;
	}

	/**
	 * Create popup HTML
	 */
	public static function create_popup() {
		$popup_content = '';
		$popup_date    = '';
		$post          = self::get_post_for_popup();

		if ( ! empty( $post ) ) {
			$popup_content = $post->post_content;
			$popup_date    = get_the_modified_date( 'U', $post );
		}

		if ( '' !== $popup_content ) {
			echo '<div class="post-popup" data-modified=' . esc_html( $popup_date ) . '>
						<div class="post-popup__dialog" role="dialog" aria-modal="true">
							<div class="post-popup__content">
								<div class="post-popup__body">' . wp_kses_post( $popup_content ) . '</div>
								<div class="post-popup__footer">
									<button>' . esc_html( __( 'Close', 'post-popup' ) ) . '</button>
								</div>
							</div>
						</div>
					</div>';
		}
	}

	/**
	 * Enqueue scripts
	 */
	public static function enqueue_scripts() {

		wp_enqueue_style( 'post-popup', esc_url( plugin_dir_url( MAIN_FILE ) . 'dist/style.css' ), array(), VERSION );
		wp_enqueue_script( 'post-popup', esc_url( plugin_dir_url( MAIN_FILE ) . 'dist/scripts.min.js' ), array(), VERSION, true );
	}
}
