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

namespace W7\Lang;

use Illuminate\Filesystem\Filesystem;
use W7\Contract\Translation\LoaderInterface;
use W7\Contract\Translation\TranslatorInterface;
use W7\Contract\View\ViewInterface;
use W7\Core\Provider\ProviderAbstract;
use W7\Lang\Loader\FileLoader;
use W7\Lang\Translator\Translator;

class ServiceProvider extends ProviderAbstract {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		if (!is_dir(BASE_PATH . '/lang/json')) {
			mkdir(BASE_PATH . '/lang/json', 0777, true);
		}

		$this->registerLoader();
		$this->registerTranslator();
	}

	public function registerLoader() {
		$this->container->set(LoaderInterface::class, function () {
			return $this->getLoader();
		});
	}

	public function registerTranslator() {
		$this->container->set(TranslatorInterface::class, function () {
			return new Translator($this->container->singleton(LoaderInterface::class), $this->config);
		});
	}

	private function getLoader() {
		$paths = [
			BASE_PATH . '/vendor/caouecs/laravel-lang/src',
			BASE_PATH . '/lang'
		];

		$loader = new FileLoader(new Filesystem(), '', $paths);
		if (\is_callable([$loader, 'addJsonPath'])) {
			$loader->addJsonPath(BASE_PATH . '/vendor/caouecs/laravel-lang/json/');
			$loader->addJsonPath(BASE_PATH . '/lang/json/');
		}

		return $loader;
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		/**
		 * @var ViewInterface $view
		 */
		$view = $this->container->singleton(ViewInterface::class);
		$view->registerFunction('itranslator', function () {
			return $this->container->singleton(TranslatorInterface::class);
		});
		$view->registerFunction('itrans', function () {
			return $this->container->singleton(TranslatorInterface::class)->trans(...func_get_args());
		});
	}

	public function providers(): array {
		return [TranslatorInterface::class, LoaderInterface::class];
	}
}
