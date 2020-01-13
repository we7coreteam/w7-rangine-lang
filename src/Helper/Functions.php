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

use W7\Lang\Translator\Translator;

if (!function_exists('itrans')) {
	function itrans($id = null, $replace = [], $locale = null) {
		if (is_null($id)) {
			return iloader()->get(Translator::class);
		}
		return iloader()->get(Translator::class)->trans($id, $replace, $locale);
	}
}
