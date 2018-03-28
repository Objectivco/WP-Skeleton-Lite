<?php

/**
 * Function helpers for the FlexibleContent suite of classes
 *
 * Class FlexibleContentSectionUtility
 */
class FlexibleContentSectionUtility {

	/**
     * Gets and returns the sections directory location
     *
     * @return string The location of the sections directory
     *
     * @since 1.1
     */
    public static function getSectionsDirectory() {
		return get_stylesheet_directory() . '/partials/sections';
	}

	/**
	 * Retrieves all the sections from the sections folder. Returns an array of options and settings per section
	 *
	 * @return array Returns an array of flexible content setup objects
	 */
	public static function getSections() {
		$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(self::getSectionsDirectory()),
			RecursiveIteratorIterator::SELF_FIRST);
		$regex = new RegexIterator($objects, '/function\.php/i', RecursiveRegexIterator::GET_MATCH);

		$sections_temp = array();

		foreach($regex as $path => $object){
			$sec_obj = require($path);

			$sec_acf_name = $sec_obj->acf_name;
			$options = $sec_obj->options;

			$sections_temp[$sec_acf_name] = $options;
		}

		return $sections_temp;
	}

	/**
	 * Gets a specified flexible section by acf name
	 *
	 * @param string $acf_name
	 *
	 * @return mixed|null Returns a flexible content setup object
	 */
	public static function getSection($acf_name) {
		$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(self::getSectionsDirectory()),
			RecursiveIteratorIterator::SELF_FIRST);
		$regex = new RegexIterator($objects, '/function\.php/i', RecursiveRegexIterator::GET_MATCH);

		$ret_obj = null;

		foreach($regex as $path => $object){
			$sec_obj = require($path);

			$sec_acf_name = $sec_obj->acf_name;

			if($sec_acf_name == $acf_name) {
				$ret_obj = $sec_obj;
			}
		}

		return $ret_obj;
	}

	/**
	 * Runs a specified flexible content section. Takes in an acf name and optional padding classes
	 *
	 * @param string $acf_name
	 * @param string $padding_classes
	 */
	public static function runSection($acf_name, $padding_classes = '') {
		$sec_obj = self::getSection($acf_name);

		$sec_obj_ops = $sec_obj->options;
		$func = $sec_obj_ops->func;
		$func($padding_classes);
	}
}
