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
	protected $configRepository;

	public function __construct(LoaderInterface $loader, RepositoryInterface $repository) {
		$this->configRepository = $repository;
		parent::__construct($loader, $this->getLocale());
	}

	public function getLocale() {
		return $this->configRepository->get('app.setting.lang', 'zh_CN');
	}
}
