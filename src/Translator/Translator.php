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

namespace W7\Lang\Translator;

use Illuminate\Contracts\Translation\Loader;
use Illuminate\Translation\Translator as TranslatorAbstract;

class Translator extends TranslatorAbstract {
	public function __construct(Loader $loader) {
		parent::__construct($loader, $this->getLocale());
	}

	public function getLocale() {
		return iconfig()->get('app.setting.lang', 'zh-CN');
	}
}
