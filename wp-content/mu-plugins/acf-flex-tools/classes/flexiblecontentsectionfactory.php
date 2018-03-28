<?php

/**
 * Class used to create a FlexibleContentSection object
 */
class FlexibleContentSectionFactory {

	/**
	 * Creates and returns a FlexibleContentSection object ready to be ran
	 *
	 * @param string $acf_name
	 *
	 * @return FlexibleContentSection
	 */
	public static function create($acf_name) {
		$sections = FlexibleContentSectionUtility::getSections();

		foreach($sections as $sec_acf_name => $options) {
			new FlexibleContentSectionItem($sec_acf_name,
				new FlexibleContentSectionItemOptions($options->func, $options->has_padding));
		}

		return new FlexibleContentSection($acf_name);
	}
}
