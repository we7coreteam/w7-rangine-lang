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

use W7\Lang\Translator\Translator;

if (!function_exists('itrans')) {
	function itrans($id = null, $replace = [], $locale = null) {
		if (is_null($id)) {
			return iloader()->get(Translator::class);
		}
		return iloader()->get(Translator::class)->trans($id, $replace, $locale);
	}
}
