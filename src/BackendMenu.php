<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor;

use Bolt\Menu\ExtensionBackendMenuInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class BackendMenu implements ExtensionBackendMenuInterface
{

    private UrlGeneratorInterface $urlGenerator;

    private TranslatorInterface $translator;

    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        TranslatorInterface $translator
    )
    {
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
    }

    public function addItems(MenuItem $menu): void
	{
        $menu->addChild('Taxonomy', [
            'extras' => [
                'name' => $this->translator->trans('caption.taxonomy'),
                'type' => 'separator',
                'icon' => 'fa-wrench',
            ],
        ]);
        $menu->addChild('Taxonomies', [
            'uri' => $this->urlGenerator->generate('taxonomy_editor_index'),
            'extras' => [
                'icon' => 'fa-folder-open',
            ],
        ]);
	}
}
