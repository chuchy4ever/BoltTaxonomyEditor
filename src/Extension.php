<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor;

use Bolt\Extension\BaseExtension;
use Symfony\Component\Filesystem\Filesystem;

final class Extension extends BaseExtension
{
	public function getName(): string
	{
		return 'Taxonomy editor';
	}

    public function initialize(): void
    {
        $this->addTwigNamespace('taxonomy-editor');
    }

	public function install(): void
	{
		$projectDir = $this->getContainer()->getParameter('kernel.project_dir');
		$public = $this->getContainer()->getParameter('bolt.public_folder');

		$source = dirname(__DIR__) . '/assets/';
		$destination = $projectDir . '/' . $public . '/assets/';

		$filesystem = new Filesystem();
		$filesystem->mirror($source, $destination);
	}
}
