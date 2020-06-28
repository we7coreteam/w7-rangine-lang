<?php

/**
 * Rangine lang
 *
 * (c) We7Team 2019 <https://www.rangine.com>
 *
 * document http://s.w7.cc/index.php?c=wiki&do=view&id=317&list=2284
 *
 * visited https://www.rangine.com for more details
 */

if (!function_exists('itranslator')) {
	/**
	 * @deprecated
	 * @return \Illuminate\Translation\Translator
	 */
	function itranslator() :  \Illuminate\Translation\Translator {
		return \W7\Lang\Facades\Translator::getFacadeRoot();
	}
}

if (!function_exists('itrans')) {
	/**
	 * @deprecated
	 * @param null $key
	 * @param array $replace
	 * @param null $locale
	 * @return array|string
	 */
	function itrans($key = null, $replace = [], $locale = null) {
		return itranslator()->trans($key, $replace, $locale);
	}
}
