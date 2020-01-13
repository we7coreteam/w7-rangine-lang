<?php

/**
 * WeEngine Api System
 *
 * (c) We7Team 2019 <https://www.w7.cc>
 *
 * This is not a free software
 * Using it under the license terms
 * visited https://www.w7.cc for more details
 */

namespace W7\Lang\Loader;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader as LaravelTranslationFileLoader;

class FileLoader extends LaravelTranslationFileLoader {
	/**
	 * @var array
	 */
	protected $paths;

	/**
	 * FileLoader constructor.
	 * @param Filesystem $files
	 * @param $path
	 * @param array $paths
	 */
	public function __construct(Filesystem $files, $path, $paths = []) {
		$this->paths = $paths;
		parent::__construct($files, $path);
	}

	/**
	 * Load the messages for the given locale.
	 *
	 * @param string $locale
	 * @param string $group
	 * @param string $namespace
	 *
	 * @return array
	 */
	public function load($locale, $group, $namespace = null) {
		$defaults = [];
		foreach ($this->paths as $path) {
			$defaults = array_replace_recursive($defaults, $this->loadPath($path, $locale, $group));
		}
		return array_replace_recursive($defaults, parent::load($locale, $group, $namespace));
	}

	/**
	 * Fall back to base locale (i.e. de) if a countries specific locale (i.e. de-CH) is not available.
	 *
	 * @param string $path
	 * @param string $locale
	 * @param string $group
	 *
	 * @return array
	 */
	protected function loadPath($path, $locale, $group) {
		if (!$path) {
			return [];
		}
		$result = parent::loadPath($path, $locale, $group);
		if (empty($result) && str_contains($locale, '-')) {
			return parent::loadPath($path, strstr($locale, '-', true), $group);
		}
		return $result;
	}
}
