<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor;

use Bolt\Extension\BaseExtension;

class Extension extends BaseExtension
{
	public function getName(): string
	{
		return 'Taxonomy editor';
	}
}