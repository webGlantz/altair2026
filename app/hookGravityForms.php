<?php
/**
 * Glantz: Hooks - Gravity Forms
 *
 * All action and filter binding for the plugin happens by calling
 * ::init() once after load.
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

namespace glantz;

class hookGravityForms extends base\hook {

	// Actions: hook=>[callbacks].
	const ACTIONS = array(

	);

	// Filters: hook=>[callbacks].
	const FILTERS = array(
		'gform_next_button'=>array(
			'input_to_button'=>array(
				'priority'=>10,
				'arguments'=>2,
			),
		),

		'gform_previous_button'=>array(
			'input_to_button'=>array(
				'priority'=>10,
				'arguments'=>2,
			),
		),

		'gform_submit_button'=>array(
			'input_to_button'=>array(
				'priority'=>10,
				'arguments'=>2,
			),
		),
	);


	/**
	* Filters the next, previous and submit buttons.
	* Replaces the form's <input> buttons with <button> while maintaining attributes from original <input>.
	*
	* @param string $button Contains the <input> tag to be filtered.
	* @param object $form Contains all the properties of the current form.
	*
	* @return string The filtered button.
	*/
	public static function input_to_button( $button, $form ) {

	    $dom = new \DOMDocument();
	    $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
	    $input = $dom->getElementsByTagName( 'input' )->item(0);
	    $new_button = $dom->createElement( 'button' );
	    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
	    $input->removeAttribute( 'value' );
	    foreach( $input->attributes as $attribute ) {
	        $new_button->setAttribute( $attribute->name, $attribute->value );
	    }
	    $input->parentNode->replaceChild( $new_button, $input );

	    return $dom->saveHtml( $new_button );
	}

}