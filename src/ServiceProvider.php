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
use W7\Core\Provider\ProviderAbstract;
use W7\Core\View\View;
use W7\Lang\Loader\FileLoader;
use W7\Lang\Translator\Translator;

class ServiceProvider extends ProviderAbstract {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		$this->registerBaseDir();
		$this->registerValidateLoader();
		$this->registerValidateTranslator();

		$this->registerLangLoader();
		$this->registerLangTranslator();

		$this->registerViewFunction();
	}

	public function registerBaseDir() {
		$this->registerOpenBaseDir(BASE_PATH . '/lang');
		if (!is_dir(BASE_PATH . '/lang/json')) {
			mkdir(BASE_PATH . '/lang/json', 0777, true);
		}
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

	public function registerValidateLoader() {
		iloader()->set('validate.loader', function () {
			return $this->getLoader();
		});
	}

	public function registerValidateTranslator() {
		iloader()->set('validate.translator', function () {
			return new Translator(iloader()->get('validate.loader'));
		});
	}

	public function registerLangLoader() {
		iloader()->set('lang.loader', function () {
			return $this->getLoader();
		});
	}

	public function registerLangTranslator() {
		iloader()->set('lang.translator', function () {
			return new Translator(iloader()->get('lang.loader'));
		});
	}

	public function registerViewFunction() {
		if (!iloader()->has(View::class)) {
			return false;
		}
		/**
		 * @var View $view
		 */
		$view = iloader()->get(View::class);
		$view->registerFunction('itrans', function () {
			return itrans(...func_get_args());
		});
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
	}
}
