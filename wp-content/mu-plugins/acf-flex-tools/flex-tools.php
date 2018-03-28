<?php

/**
 * The FlexibleContentSection class should be created using the FlexibleContentSectionFactory class. It takes care of
 * the automation of the child classes needed for the FlexibleContentSection to work.
 *
 * Check out the FlexibleContentSectionFactory classes create method of an implementation example
 */

require_once( 'classes/flexiblecontentsectionfactory.php' );
require_once( 'classes/flexiblecontentsectionitem.php' );
require_once( 'classes/flexiblecontentsectionitemoptions.php' );
require_once( 'classes/flexiblecontentsectionutility.php' );

class FlexibleContentSection {

	/**
	 * @var string
	 */
	protected $acf_name = '';

	/**
	 * FlexibleContentSection constructor.
	 *
	 * @param string $acf_name
	 */
	public function __construct($acf_name) {
		$this->setAcfName($acf_name);
	}

	/**
	 *  Runs the flexible content section
	 */
	public function run() {
		// If ACF Pro is installed, run the setup
		if(function_exists('the_flexible_field')) {
			$count = 0;

			// Call each sections display function based on the current layout in the loop - Found in functions.php
			while ( the_flexible_field( $this->acf_name ) ):

				$next_count = $count + 1;
				$padding = $this->getPaddingClasses($next_count);
				$instance = FlexibleContentSectionItem::getInstance(get_row_layout());

				// Call the corresponding function
				$func = $instance->getOptions()->getFunc();
				$func($padding);

				$count++;

			endwhile;
		}
	}

	/**
	 * @param int $next_count The next count increment in the length of the flex field
	 *
	 * @return string Returns a concatenated string of the needed padding classes
	 */
	public function getPaddingClasses($next_count) {
		// Set both top and bottom padding to false by default
		$top_padding = false;
		$bot_padding = false;
		$next_has_padding = false;
		$flex_field = null;
		$class_str = '';

		if(function_exists('the_flexible_field')) {
			$flex_field = get_field( $this->acf_name );
		}

		$cur_has_padding = FlexibleContentSectionItem::getInstance( get_row_layout() )->getOptions()->getHasPadding();

		// $flex_field[$count+1]['acf_fc_layout'] gets the next acf name
		if ( isset( $flex_field[ $next_count ]['acf_fc_layout'] ) ) {
			$next_name        = $flex_field[ $next_count ]['acf_fc_layout'];
			$next_has_padding = FlexibleContentSectionItem::getInstance( $next_name )->getOptions()->getHasPadding();
		}

		// If the current item has padding
		if ( $cur_has_padding ) {

			// It always gets top padding if it's supposed to have padding
			$top_padding = true;

			// If the next item does not have padding, give the current item bottom padding
			if ( ! $next_has_padding ) {
				$bot_padding = true;
			}
		}

		// Padding array containing our values for if we need top and bottom padding
		$padding = array(
			'top' => $top_padding,
			'bot' => $bot_padding
		);

		$class_str = ( ( $padding['top'] ) ? 'has-top-padding' : '' ) . ( ( $padding['top'] || $padding['bot'] ) ? ' ' : '' ) .
		             ( ( $padding['bot'] ) ? 'has-bot-padding' : '' );

		return $class_str;
	}

	/**
	 * @return string
	 */
	public function getAcfName() {
		return $this->acf_name;
	}

	/**
	 * @param string $acf_name
	 */
	public function setAcfName( $acf_name ) {
		$this->acf_name = $acf_name;
	}
}
