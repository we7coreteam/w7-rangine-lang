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

namespace W7\Lang\Translator;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\Translator as TranslatorAbstract;
use W7\Lang\Loader\FileLoader;

class Translator extends TranslatorAbstract {
	public function __construct() {
		parent::__construct($this->getFileLoader(), $this->getLocale());
	}

	private function getFileLoader() {
		$paths = [
			BASE_PATH . '/vendor/caouecs/laravel-lang/src/',
			BASE_PATH . '/lang/'
		];

		$loader = new FileLoader(new Filesystem(), '', $paths);
		if (\is_callable([$loader, 'addJsonPath'])) {
			$loader->addJsonPath(BASE_PATH . '/vendor/caouecs/laravel-lang/json/');
			$loader->addJsonPath(BASE_PATH . '/config/lang/json/');
		}
		return $loader;
	}

	public function getLocale() {
		$config = iconfig()->getUserAppConfig('setting');
		return $config['lang'] ?? 'zh-CN';
	}
}
