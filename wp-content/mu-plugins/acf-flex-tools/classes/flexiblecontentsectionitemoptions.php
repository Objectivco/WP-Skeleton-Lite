<?php

/**
 * Class FlexibleContentSectionItemOptions holds the callback function and has padding flag used in determining
 * where and when to add padding to a FlexibleContentSectionItem
 */
class FlexibleContentSectionItemOptions {

	/**
	 * @var null
	 */
	protected $func = null;
	/**
	 * @var bool
	 */
	protected $has_padding = false;

	/**
	 * FlexibleContentSectionItemOptions constructor.
	 *
	 * @param callback $func
	 * @param bool $has_padding
	 */
	public function __construct($func, $has_padding) {
		$this->setFunc($func);
		$this->setHasPadding($has_padding);
	}

	/**
	 * @return null
	 */
	public function getFunc() {
		return $this->func;
	}

	/**
	 * @param null $func
	 */
	public function setFunc( $func ) {
		$this->func = $func;
	}

	/**
	 * @return boolean
	 */
	public function getHasPadding() {
		return $this->has_padding;
	}

	/**
	 * @param boolean $has_padding
	 */
	public function setHasPadding( $has_padding ) {
		$this->has_padding = $has_padding;
	}
}
