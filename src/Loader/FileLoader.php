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

namespace W7\Lang\Loader;

use Illuminate\Translation\FileLoader as LaravelTranslationFileLoader;
use W7\Contract\Translation\LoaderInterface;

class FileLoader extends LaravelTranslationFileLoader implements LoaderInterface {
}
