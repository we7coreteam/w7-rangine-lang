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

use Illuminate\Translation\Translator as TranslatorAbstract;
use W7\Contract\Config\RepositoryInterface;
use W7\Contract\Translation\LoaderInterface;
use W7\Contract\Translation\TranslatorInterface;

class Translator extends TranslatorAbstract implements TranslatorInterface {
	/**
	 * @var RepositoryInterface
	 */
	protected $repository;

	public function __construct(LoaderInterface $loader, RepositoryInterface $repository) {
		parent::__construct($loader, $this->getLocale());
		$this->repository = $repository;
	}

	public function getLocale() {
		return $this->repository->get('app.setting.lang', 'zh-CN');
	}

	public function trans($key, array $replace = [], $locale = null) {
		return $this->get($key, $replace, $locale);
	}
}
