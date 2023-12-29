<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor;

use Bolt\Menu\ExtensionBackendMenuInterface;
use Knp\Menu\MenuItem;

final class Menu implements ExtensionBackendMenuInterface
{

	public function addItems(MenuItem $menu): void
	{
		dump($menu);
		exit();
	}
}
