<?php

/**
 * Class FlexibleContentSectionItem represents a single Flexible Content Section Item.
 */
class FlexibleContentSectionItem {

	/**
	 * @var array
	 */
	protected static $instances = array();

	/**
	 * @var string
	 */
	protected $acf_name = '';
	/**
	 * @var null
	 */
	protected $options = null;

	/**
	 * FlexibleContentSectionItem constructor.
	 *
	 * @param string $acf_name
	 * @param FlexibleContentSectionItemOptions $options
	 */
	public function __construct($acf_name, $options) {
		$this->setAcfName($acf_name);
		$this->setOptions($options);

		self::setInstance($this);
	}

	/**
	 * Returns an instance of FlexibleContentSectionItem with the specified acf name
	 *
	 * @param string $acf_name
	 *
	 * @return object
	 */
	public static function getInstance($acf_name) {
		$ret_instance = (object) array();

		foreach(self::$instances as $instance) {
			if($instance->acf_name == $acf_name) {
				$ret_instance = $instance;
			}
		}

		return $ret_instance;
	}

	/**
	 * Adds the specified instance of FlexibleContentSectionItem to the static instances array
	 *
	 * @param $instance
	 */
	public static function setInstance($instance) {
		self::$instances[] = $instance;
	}

	/**
	 * @return array
	 */
	public static function getInstances() {
		return self::$instances;
	}

	/**
	 * @param array $instances
	 */
	public static function setInstances( $instances ) {
		self::$instances = $instances;
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

	/**
	 * @return null
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @param null $options
	 */
	public function setOptions( $options ) {
		$this->options = $options;
	}
}
