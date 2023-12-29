<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor;

use Bolt\Extension\BaseExtension;
use Bolt\Menu\Menu;

final class Extension extends BaseExtension
{
	public function getName(): string
	{
		return 'Taxonomy editor';
	}

	/**
	 * Add Menu item for this extension to Bolt's Backend
	 * {@inheritdoc}
	 */
	protected function registerMenuEntries()
	{

		$config = $this->getConfig();

		$menu = new MenuEntry('taxonomyeditor', 'taxonomyeditor');
		$menu->setLabel(Trans::__('taxonomyeditor.taxonomyitem', ['DEFAULT' => 'Taxonomy editor']))
		 ->setIcon('fa:tags')
		 ->setPermission($config['permission']);

		return [
		 $menu,
		];
	}
}
