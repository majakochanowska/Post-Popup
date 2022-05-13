<?php
/**
 * Register ACF fields
 *
 * @package post-popup
 */

namespace Maja\PostPopup\Modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Maja\PostPopup\Interfaces\Module;

/**
 * Class definition
 */
class Acf implements Module {

	/**
	 * Register WordPress hooks
	 */
	public static function register() {

		add_action( 'acf/init', array( get_class(), 'register_display_in_popup_field' ) );
	}

	/**
	 * Register "Display in popup" field
	 */
	public static function register_display_in_popup_field() {

		acf_add_local_field_group(
			array(
				'key'                   => 'post-popup_group_display_in_popup',
				'title'                 => __( 'Popup', 'post-popup' ),
				'fields'                => array(
					array(
						'key'               => 'field_display_in_popup',
						'label'             => __( 'Display in popup', 'post-popup' ),
						'name'              => 'display_in_popup',
						'type'              => 'true_false',
						'instructions'      => __( 'Check to show this page content in the popup.', 'post-popup' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'message'           => '',
						'default_value'     => 0,
						'ui'                => 1,
						'ui_on_text'        => '',
						'ui_off_text'       => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'post-popup',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
			)
		);
	}
}
