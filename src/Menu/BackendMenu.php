<?php

declare(strict_types=1);

namespace Chuchy4ever\TaxonomyEditor\Menu;

use Bolt\Configuration\Config;
use Bolt\Menu\BackendMenuBuilderInterface;
use Bolt\Menu\ExtensionBackendMenuInterface;
use Bolt\Repository\ContentRepository;
use Bolt\Twig\ContentExtension;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final class BackendMenu implements BackendMenuBuilderInterface
{
	public const MAX_LATEST_RECORDS = 5;

	private FactoryInterface $menuFactory;

	private Config $config;

	private ContentRepository $contentRepository;

	private UrlGeneratorInterface $urlGenerator;

	private TranslatorInterface $translator;

	private ContentExtension $contentExtension;

	/** @var array<int,ExtensionBackendMenuInterface> */
	private array $extensionMenus;

	private AuthorizationCheckerInterface $authorizationChecker;

	/**
	 * @param array<int,ExtensionBackendMenuInterface> $extensionMenus
	 */
	public function __construct(
		FactoryInterface $menuFactory,
		iterable $extensionMenus,
		Config $config,
		ContentRepository $contentRepository,
		UrlGeneratorInterface $urlGenerator,
		TranslatorInterface $translator,
		ContentExtension $contentExtension,
		AuthorizationCheckerInterface $authorizationChecker
	) {
		$this->menuFactory = $menuFactory;
		$this->config = $config;
		$this->contentRepository = $contentRepository;
		$this->urlGenerator = $urlGenerator;
		$this->translator = $translator;
		$this->contentExtension = $contentExtension;
		$this->extensionMenus = $extensionMenus;
		$this->authorizationChecker = $authorizationChecker;
	}

	private function createAdminMenu(): ItemInterface
	{
		$t = $this->translator;
		$menu = $this->menuFactory->createItem('root');
        $menu->addChild('Taxonomy edit', [
			'uri' => $this->urlGenerator->generate('taxonomy_editor'),
            'extras' => [
                'name' => $t->trans('taxonomy_editor.title'),
                'type' => 'separator',
                'icon' => 'fa-file',
            ],
        ]);

		return $menu;
	}

	public function buildAdminMenu(): array
	{
		$menuData = [];
		foreach ($this->createAdminMenu()->getChildren() as $child)
		{
            $menuData[] = [
                'name' => $child->getExtra('name') ?: $child->getLabel(),
                'singular_name' => $child->getExtra('singular_name'),
                'slug' => $child->getExtra('slug'),
                'singular_slug' => $child->getExtra('singular_slug'),
                'icon' => $child->getExtra('icon'),
                'link' => $child->getUri(),
                'link_new' => $child->getExtra('link_new'),
                'singleton' => $child->getExtra('singleton'),
                'type' => $child->getExtra('type'),
                'active' => $child->getExtra('active'),
                'submenu' => [],
            ];
		}

		return $menuData;
	}
}
