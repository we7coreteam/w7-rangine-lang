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

if (!function_exists('itrans')) {
	/**
	 * @param null $id
	 * @param array $replace
	 * @param null $locale
	 * @return mixed
	 */
	function itrans($id = null, $replace = [], $locale = null) {
		if (is_null($id)) {
			return iloader()->get('lang.translator');
		}
		return iloader()->get('lang.translator')->trans($id, $replace, $locale);
	}
}
